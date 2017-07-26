<?php

use Illuminate\Database\Seeder;

use App\Http\Requests;
use App\Models\Comp_Part as compart;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{

    /**
dase seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //$this->call(PermisosSeeder::class);
        //$this->call(UserSeeder::class);
        //$this->call(ModulosTable::class);

        $filas =  compart::all();

        $binary = [];
        foreach($filas as $clave => $dato)
        {
            if($dato->validado == 0 && $dato->imagen_convertida == 0){
                echo $dato->participante->persona->nombres."\n";
                
                $binary = base64ToBinary($dato->imagen_deposito);
                $name = md5( Carbon::now().'_deposito'.$clave).$binary[0];

                \Storage::disk('recibos_pagos')->put(
                    $name,
                    base64_decode($binary[1])
                );
                $dato->imagen_deposito = $name;
                $dato->imagen_convertida = 1;
                $dato->save();
            }
        }
    }

}
