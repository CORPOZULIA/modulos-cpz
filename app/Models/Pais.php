<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'paises';
    protected $fillable = ['nombre_pais', 'codigo_pais'];


    public function personas()
    {
    	return $this->hasMany('App\Models\Persona');
    }

    public function ciudades()
    {
    	return $this->hasMany('App\Models\Ciudad');
    }
}
