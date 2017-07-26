<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Comp_Part as cp;

class TipoCompetencia extends Model
{
   protected $table = 'competencia.tipo_competencia';
   protected $fillable = [
   		'nombre_tipo', 'cod_tipo', 'competencia_id', 'num_minimo', 'num_maxima'
   ];

   public function inscripciones()
   {
   		return $this->hasMany('App\Models\Comp_Part');
   }

}
