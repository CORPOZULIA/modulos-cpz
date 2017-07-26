<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discapacidad extends Model
{
    protected $table = 'discapacidades';

    protected $fillable = ['nombre_discapacidad', 'codigo_discapacidad', 'tip_disc_id'];


    public function tipo()
    {
    	return $this->belonsTo('App\Models\TipoDiscapacidad', 'tip_disc_id', 'id');
    }

    public function personas()
    {
    	return $this->hasMany('App\Models\Persona');
    }
}
