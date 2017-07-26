<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comp_Part as cp;
use App\Models\Discapacidad;

class Categoria extends Model
{
    protected $table = 'competencia.categorias';
    protected $fillable = [
    	'nombre_categoria', 'codigo', 'edad_minima', 'edad_maxima', 'sexo_id', 'discapacidad_id', 'descripcion_cat'
    ];


    public function misCategorias()
    {
    	return $this->hasMany('App\Models\CompCarPart');
    }
}
