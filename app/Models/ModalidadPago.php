<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadPago extends Model
{
    protected $table = 'competencia.modalidad_pago';
    protected $fillable = [
    	'denominacion_tipo', 'cod_modalidad'
    ];


    public function inscripciones()
    {
    	return $this->hasMany('App\Models\Comp_Part');
    }
}
