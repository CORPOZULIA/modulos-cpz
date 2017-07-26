<?php

namespace App\App\Http\Controllers\Modulos\bienes\modelos;

use Illuminate\Database\Eloquent\Model;

class Activo extends Model
{
    protected $table = 'bienes.activos';

    protected $fillable = ['nombre_activo','codigo_activo','serial_activo','descripcion_activo','costo_inicial_activo','deprecia_activo','tiempo_deprec_activo','porcent_deprec_anual_activo'];
}
