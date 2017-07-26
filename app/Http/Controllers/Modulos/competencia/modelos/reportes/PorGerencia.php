<?php

namespace App\Http\Controllers\Modulos\competencia\modelos\reportes;

use Illuminate\Database\Eloquent\Model;

class PorGerencia extends Model
{
    protected $table = 'competencia.por_gerencia';
    protected $fillable = [
    	'totales', 'gerencia'
    ];
}
