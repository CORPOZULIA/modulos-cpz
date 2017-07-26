<?php

namespace App\Http\Controllers\extras;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Comp_Part as compart;
use Storage;

class Parser
{

    
    public function saveFile()
    {
    	$filas =  compart::where('validado', 0)->get();

    	foreach($filas as $clave => $dato)
    	{
    		print $dato->imagen_deposito;
    		exit;
    	}
        $binary = base64ToBinary($request->imagen_deposito);
        
        $name = md5( Carbon::now().'_deposito').$binary[0];
        Storage::disk('recibos_pagos')->put(
            $name,
            base64_decode($binary[1])
        );

    }

}

$p = new Parser();
$p->saveFile();