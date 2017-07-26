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
use App\Http\Controllers\Modulos\competencia\modelos\reportes\PorGerencia as pg;
use App\Models\TipoCompetencia as tc;

use Carbon\Carbon;

use PDF;

class Reportes extends Controller
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

	public function __construct($id = 0)
	{
		if($id != 0)
		{
			$this->mods = ModPerUser::getModulos(Auth::user()->id);
        	$this->modulo_id = $id;
        }
	}

    public function index(Request $request, $id = '')
    {
    	return view('intranet.carrera.reportes', ['modulos' => $this->mods]);
    }

    /**
     * GENERAR EL COMPROBANTE DEL PARTICIPANTE
     * @param  Request $request objeto request de la solicitud
     * @return  Object           DOMPDF - PDF 
     */
    public function verComprobante(Request $request)
    {
    	$code = $request->input('_code');

    	$decode = json_decode( base64_decode($code) );

    	$tipo_competencia = tc::where('estado_competencia', 'P')
    						->join('competencia.competencias', 'competencia.competencias.id', '=','competencia.tipo_competencia.competencia_id')->get();
    	
    	$tallas = ['S', 'M', 'L', 'XL', 'XXL'];

    	$solicitude = solicitudes::find($decode->id);
    	$data = [
    		'tallas' => $tallas,
    		'persona' => $solicitude->participante->persona,
    		'solicitud' => $solicitude,
    		'tipos' => $tipo_competencia,

    	];
    	$html = \View::make('intranet.carrera.reportes.comprobante', $data)->render();
    	$pdf = \App::make('dompdf.wrapper');
    	$pdf_m = $pdf->loadHTML($html);
    	return $pdf_m->stream('invoice');
    }

    public function generarReporte(Request $request, $method = '')
    {
        if(!$request->has('ajax'))
        {
            $response = call_user_func_array([ $this, $method ], []);
            return response($response, 200)
                ->header('Content-Type', 'application/json');
        }
        else
        {
            $por_gerencia = \DB::table('competencia.por_gerencia')
                        ->orderBy('totales', 'DESC')->get();
                        
            $por_evento = \DB::table('competencia.detalle_por_gerencia')
                            ->select(\DB::raw('count(*) as cantidad, nombre_tipo'))
                            ->groupBy('nombre_tipo')
                            ->get();

            $datos = call_user_func_array([ $this, $method ], [$request]);

            $data = [
                'datos' => $datos,
                'totales' => $por_gerencia,
                'por_evento' => $por_evento,
                'filtro' => $request->filtro,
            ];
            $vista = \View::make('intranet.carrera.reportes.por_gerencia', $data)->render();
            $pdf = \App::make('dompdf.wrapper')
                        ->loadHTML($vista);
            return $pdf->stream('invoice');
        }
    }

    private function PorGerencia($filter = array()){

        $data = \DB::table('competencia.detalle_por_gerencia');

        if( !empty($filter->fecha_hasta) )
            $data->where('created_at', '<=', Carbon::parse($filter->fecha_hasta)->format('Y-m-d H:i:s') );

        if( !empty($filter->fecha_desde) )
            $data->where('created_at', '>=',Carbon::parse($filter->fecha_desde)->format('Y-m-d H:i:s'));

        return $data->get();
    }

    private function PorValidacion($filter)
    {   
        $data = \DB::table('competencia.detalle_por_gerencia');

        if( !empty($filter->filtro))
            $data->where('validado', '=', $filter->filtro);

        if( !empty($filter->fecha_hasta) )
            $data->where('created_at', '<=', Carbon::parse($filter->fecha_hasta)->format('Y-m-d H:i:s') );

        if( !empty($filter->fecha_desde) )
            $data->where('created_at', '>=',Carbon::parse($filter->fecha_desde)->format('Y-m-d H:i:s'));

        
        return $data->get();
    }

    public function EntreFechas($datos)
    {
        $data = \DB::table('competencia.detalle_por_gerencia')
                    ->where('created_at', '<=', Carbon::parse($datos->fecha_hasta)->format('Y-m-d H:i:s') )
                    ->where('created_at', '>=',Carbon::parse($datos->fecha_desde)->format('Y-m-d H:i:s'));
        return $data->get();
    }
}
