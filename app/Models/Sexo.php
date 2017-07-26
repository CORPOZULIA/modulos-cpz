<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sexo extends Model
{
    protected $table = 'sexo';
    protected $fillable = ['codigo_sexo'];


    public function personas()
    {
    	return $this->hasMany('App\Models\Persona');
    }
}
