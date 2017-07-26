<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
   	protected $table = 'competencia.competencias';
   	protected $fillable = ['titulo_competencia', 'descripcion_competencia', 'estado_competencia', 'fecha_inic_insc', 'fecha_fin_insc'];
}
