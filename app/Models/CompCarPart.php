<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompCarPart extends Model
{
    protected $table = 'competencia.categoria_carrera_participante';

    protected $fillable = [
    	'competencia_participante_id', 'categoria_id', 
    ];

    public function categorias()
    {
    	return $this->belongsTo('App\Models\Categoria');
    }

    public function participante()
    {
    	return $this->belongsTo('App\Models\Comp_Part');
    }

}
