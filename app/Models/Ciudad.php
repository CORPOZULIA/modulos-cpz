<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
	protected $table = 'ciudades';
	protected $fillable = ['nombre_ciudad', 'codigo_ciudad', 'pais_id'];

	public function personas()
	{
		return $this->hasMany('App\Models\Persona');
	}

	public function pais()
	{
		return $this->belongsTo('App\Models\Pais');
	}
	
}
