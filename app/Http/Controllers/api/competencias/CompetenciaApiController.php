<?php

namespace App\Http\Controllers\api\competencias;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Models\Discapacidad;
use App\Models\Nacionalidad;
use App\Models\Ciudad;
use App\Models\Sexo;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Participante;
use App\Models\Comp_Part;
use App\Models\Competencia;
use Mail;
use Storage;


class CompetenciaApiController extends Controller
{
    private $comp;

    public function __construct()
    {
        $this->comp = Competencia::where('estado_competencia', 'P')->first();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		
        $response = [
            'error' => false,
            'mensaje' => 'Solicitud registrada exitosamente',
            'fecha' => Carbon::now(),
            'request' => $request->all()
        ];
        return response($response, 200)
                ->header('Content-Type', 'application/json');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       try{

            $except = [
                '_token', 'telefono_personal', 'imagen_deposito', 'guarda_ropa'   
            ];

      
            $persona = Persona::create( $request->except($except) );
            //VERIFICACIÓN DE QUE EL REGISTRO DE LA PERSONA SE REALICE EXITOSAMENTE
            if($persona)
            {

                if( 
                    $persona->participante()->save( 
                        new Participante( $request->only(['recibir_sms']) )
                    )
                ){
                    $competencia = [
                        'participante_id'=> $persona->participante->id,
                        'competencia_id' => $this->comp->id,
                        'numero_deposito'=> $request->numero_deposito,
                        'guarda_ropa'    => $request->guarda_ropa
                    ];
                    if( $persona->participante->inscripcion()->save( new Comp_Part($competencia) ) )
                    {
                        $correo = [
                            'nombres' => $request->nombres,
                            'apellidos' => $request->apellidos,
                            'cedula'  => $request->cedula,
                            'correo'  => $request->email,
                            'fec_nac' => $persona->fecha_nacimiento,
                            'telefono' => $request->telefono_personal,
                            'nacionalidad_cod'      => $persona->nacionalidad->codigo_nac,
                            'nacionalidad' => $persona->nacionalidad->descripcion_nac,
                        ];

                        $this->saveFile($request, $persona);
                        
                        Mail::send('emails.registro_exitoso', $correo,function($msj) use($request){
                            $msj->from('info@carreracaminatagaitera.org.ve', 'Registro exitoso!');
                            $msj->to($request->email)->subject('Notificación de registro');
                        });

                        $response = [
                            'error' => false,
                            'mensaje' => 'Gracias por registrarse en este evento, revise su correo electronico para confirmar su registro!.',
                        ];
                        return response($response, 200)
                                ->header('Content-Type', 'application/json');
                    }
                }
            }


        //SI SE GENERA UNA EXCEPCION
       }catch(\Exception $e){

            $str = '';
            $str = strstr($e->getMessage(), 'duplicate key');
            
            if($str!='')
            {
                return  response([
                        'error' => true, 
                        'mensaje' => 'Error 203: este numero de cedula ya existe en la base de datos',
                        'error_code' => 203,
                    ], 500)->header('Content-Type','application/json');
            }

            return  response($e->getMessage(), 200)->header('Content-Type','application/json');
       }

    } // FIN DE LA FUNCION STORE

    private function storeCompPart($persona, $request)
    {

    }

   

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    private function saveFile($request, $persona)
    {
        $binary = base64ToBinary($request->imagen_deposito);
        
        $name = md5( Carbon::now().'_deposito').$binary[0];
        Storage::disk('recibos_pagos')->put(
            $name,
            base64_decode($binary[1])
        );

        \DB::table('competencia.competencia_participante')
            ->where('participante_id', $persona->participante->id)
            ->update(['imagen_deposito' => $name]);
    }



}
