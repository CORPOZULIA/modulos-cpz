<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nacionalidad extends Model
{
	protected $table = 'nacionalidades';

	protected $fillable = ['codigo_nac', 'descripcion_nac'];

	public function personas()
	{
		return $this->hasMany('App\Models\Persona');
	}
}
