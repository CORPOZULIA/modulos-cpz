<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comp_Part extends Model
{
    protected $table = 'competencia.competencia_participante';
    protected $fillable = [ 'competencia_id', 'participante_id', 'guarda_ropa', 'numero_deposito', 'imagen_deposito', 'guarda_ropa', 'talla', 'validado',  'imagen_convertida', 'mi_numero', 'tipo_competencia_id'
    ];

    public function participante()
    {
    	return $this->belongsTo('App\Models\Participante');
    }

    public function modalidad_pago()
    {
    	return $this->belongsTo('App\Models\ModalidadPago');
    }

    public function tipo_competencia()
    {
    	return $this->belongsTo('App\Models\TipoCompetencia');
    }

    public function misCategorias()
    {
    	return $this->hasMany('App\Models\CompCarPart');
    }

    public function getMiNumeroAttribute($value)
    {
        if( $value < 10 )
            $value = '000'.$value;
        else if( $value < 100 )
            $value = '00'.$value;
        else if( $value < 1000 )
            $value = '0'.$value;

        return $value;
    }
}
