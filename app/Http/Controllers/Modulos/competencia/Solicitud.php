<?php
namespace App\Http\Controllers\Modulos\competencia;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ModPerUser;
use App\User;
use App\Persona;
use App\Empleado;
use App\Modulo;
use App\Models\Comp_Part as solicitudes;
use App\Models\Categoria as categorias;
use App\Models\CompCarPart as asignadas;
use App\Models\TipoCompetencia as tc;
use Carbon\Carbon;
use Storage;
use Mail;
/**
/	GESTION DE SOLICITUDES DE REGISTRO DE LA CARRERA CAMINATA
/	---------------------------------------------------------
/		MODULO QUE SE ENCARGA DE GESTIONAR (REVISAR, VALIDAR Y APROBAR)
/		LAS SOLICITUDES DE REGISTRO DE PARTICIPANTES DE LA CARREA
/		LOS USUARIOS DEL MODULO USAN ESTGE ARCHIVO COMO BASE 
/		PARA VALIDAR PAGOS Y DE MAS ACTIVIDADES COMUNES
/	---------------------------------------------------------
/		@author Giovanny Avila
/		@date 20 - 03 -2017
*/
class Solicitud extends Controller
{
	/**
	 * $mods array de modulos a los que el usuario
	 * tiene permisos
	 * @var array
	 */
	private $mods;

	/**
	 * $modulo_id  id del modulo al que el usuario tiene permisos
	 * @var integer
	 */
    private $modulo_id;

	public function __construct($id)
	{
		$this->mods = ModPerUser::getModulos(Auth::user()->id);
        $this->modulo_id = $id;
	}


	public function index(Request $request, $id='')
	{
		return view('intranet.carrera.index', ['modulos' => $this->mods]);
	}

	/**
	 * FUNCION PARA OBTENER MEDIANTE AJAX TODOS LAS SOLICITUDES ALMACENADAS
	 * (TODAS LAS QUE NO HAYAN SIDO VALIDADAS DENTRO DE LA TABLA COMPETENCIA_PARTICIPANTE)
	 * 
	 */
	public function getSolicitudes(Request $request, $id='')
	{
		$rows = solicitudes::where('validado', 0)->get();

		$solicitudes = [];
		foreach($rows as $clave => $valor){
			$solicitudes[$clave]['solicitud'] = $valor;
			$solicitudes[$clave]['solicitud']['competencia'] = $valor->tipo_competencia;
			$solicitudes[$clave]['personas'] = $valor->participante->persona;
			$solicitudes[$clave]['pago'] = $valor->modalidad_pago;
		}

		return response($solicitudes, 200)
				->header('Content-Type', 'application/json');
	}

	/**
	 * FUNCION PARA VALIDAR LA INSCRIPCIÓN, ASIGNA LAS CATEGORIAS A LAS QUE PERTENECERA
	 * UNA PERSONA
	 * @param  Request $request DATOS DEL REQUEST
	 * @param  string  $id      OPCIONAL / ID DE UNA PERSONA
	 * @return Json 	  		respuesta           
	 */
	public function validarSolicitud(Request $request, $id='')
	{ 	
		if(! verificar_permisos('UPDATE', $this->modulo_id) )
			return response([
					'error' => true, 
					'mensaje' => 'No posee permisos para realizar esta acción'
				])->header('Content-Type', 'application/json');

		$solicitud = solicitudes::find($request->solicitud_id);

		$fn = $solicitud->participante->persona->fecha_nacimiento;
		$diff = new Carbon($fn);
		$edad = $diff->diffinYears(Carbon::now());

		$categorias = categorias::where(
				'discapacidad_id', 
				$solicitud->participante->persona->discapacidad_id)
				->where('edad_minima', '<=', $edad)
				->Where('edad_maxima', '>=', $edad)
				->get();

		\DB::beginTransaction();
		foreach($categorias as $clave => $categoria)
		{
			/**
			 * asignadas es un alias para el modelo ComCarPart
			 * este proceso inserta los registros de las categorias
			 * correspondientes a una persona
			 * si ocurre una excepción es atrapada y se responde con un error
			 *
			 * SE INICIA UNA TRANSACCIÓN SI TODAS LAS INSERCIONES SE REALIZAN
			 * DE MANERA EXITOSA SE HACE EL COMMIT
			 * DE CASO CONTRARIO SE ATRAPA LA EXCEPCION Y SE EJECUTA UN
			 * ROLLBACK
			 */
			
			try{
				$data = asignadas::create([
					'competencia_participante_id' => $request->solicitud_id,
					'categoria_id' => $categoria->id
				]);
			}catch(\Exception $e){
				\DB::rollback();
				return response(['error' => true, 'mensaje' => 'Ha ocurrido un error inesperado '], 200)
						->header('Content-Type', 'application/json');
			}

		}
		/**
		 * ENVIO DE CORREO ELECTRONICO A LA PERSONA POSTERIOR A LA ASIGNACION DE
		 * SUS RESPECTIVAS CATEGORÍAS, SI EL ENVIO DE CORREO NO ES EXITOSO Y OCURRE
		 * ALGUN ERROR, SE HACE UN ROLLBACK DE LA TRANSACCIÓN 
		 */
		try{
			$solicitud->validado = 1;
			$solicitud->mi_numero = $this->getMiNumero($solicitud->tipo_competencia_id);
			$datos = [
				'categorias' => $categorias,
				'persona' => $solicitud->participante->persona,
				'numero' => $solicitud->mi_numero,
				'token' => base64_encode( json_encode([
					'id' => $solicitud->id,
					'cedula' => $solicitud->participante->persona->cedula,
					'fecha' => Carbon::now()->format('Y-m-d'),
				]) ),
			];
			$solicitud->save();
			$this->sendMail('emails.validacion', $datos, $solicitud);
			\DB::commit();
		}catch(\Exception $e){
			\DB::rollback();
			return response(['error' => true, 'mensaje' => $e->getMessage()], 200)
						->header('Content-Type', 'application/json');
		}

		push_auditoria('El usuario ejercio una accion de validación de la persona '.$solicitud->participante->persona->nombres, 'competencia', 'usuarios');
			//COMMIT DE LA TRANSACCIÓN

		return response(['error' => false, 'mensaje' => 'Se ha validado el competidor de manera exitosa, un correo se le envio.'], 200)
				->header('Content-Type', 'application/json');	
	}


	public function sendMail($vista, $datos, $otros = '')
	{

		Mail::send($vista, $datos, function($msj) use ($otros) {
			$msj->from('gjavila1995@gmail.com', 'Validación de registro');
			$msj->to( $otros->participante->persona->email )->subject('Validación de registro');
		} );
	}
	
	//EPITALUA@CORPOZULIA.GOB.VE
	/**
	 * OBTENER EL NUERO ASIGNADO A UNA PERSONA DE ACUERDO AL TIPO DE 
	 * COMPETENCIA AL QUE SE INSCRIBIO ESA PERSONA
	 * ------------------------------------------------------------------
	 * 		EL ALGORITMO OBTIENE EL NUMERO TOTAL DE PERSONAS INSCRITAS
	 * 		Y VALIDADAS (PARA ESE MOMENTO) A ESE TIPO DE COMPETENCIA
	 * 		SE LO SUMA A LA NUMERACIÓN MINIMA Y OBTIENE EL NUMERO
	 * 	 	EXACTO ASIGNADO A ESA PERSONA
	 *
	 * 		SI ESA SUMA ES MAYOR A LA NUMERACIÓN MAXINA LANZA
	 * 		UNA EXCAPCION INDICANDO EL ERROR QUE SE GENERÓ
	 * ------------------------------------------------------------------
	 * @param  INTEGER $tipo ID DEL TIPO DE COMPETENCIA
	 * @return INTEGER       NÚMERO ASIGNADO A LA PERSONA
	 */
	public function getMiNumero($tipo)
	{
		$var = \DB::table('general.personas')
			->join('competencia.participantes', 'general.personas.id', '=' ,'competencia.participantes.persona_id')
			->join('competencia.competencia_participante' ,'competencia.participantes.id', '=' ,'competencia.competencia_participante.participante_id')
			->join('competencia.tipo_competencia' ,'competencia.competencia_participante.tipo_competencia_id','=' ,'competencia.tipo_competencia.id')
			->where('competencia.tipo_competencia.id', '=' ,$tipo)
			->where('competencia.competencia_participante.validado', '=', 1)->count();

		$tc = tc::find($tipo);
		if( ($tc->num_minimo + $var ) > $tc->num_maxima ) 
			throw new \Exception('Numeración maxima excedida para este tipo de competencia, contacte al comite organizador  Error #33');

		return ($tc->num_minimo + $var);
	}
}