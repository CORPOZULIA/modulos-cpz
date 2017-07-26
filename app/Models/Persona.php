<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
    	'nombres', 'apellidos', 'cedula', 'email', 'nacionalidad_id',
    	'pais_id', 'ciudad_id', 'discapacidad_id', 'sexo_id', 'fecha_nacimiento',
    ];


    public function nacionalidad()
    {
    	return $this->belongsTo('App\Models\Nacionalidad');
    }

    public function pais()
    {
    	return $this->belongsTo('App\Models\Pais');
    }

    public function ciudad()
    {
        return $this->belongsTo('App\Models\Ciudad');
    }

    public function discapacidad()
    {
        return $this->belongsTo('App\Models\Discapacidad');
    }

    public function sexo()
    {
        return $this->belongsTo('App\Models\Sexo');
    }


    public function participante()
    {
        return $this->hasOne('App\Models\Participante');
    }

    public function setNombresAttribute($value)
    {
        $this->attributes['nombres'] = ucwords($value);
    }


    public function setapellidosAttribute($value)
    {
        $this->attributes['apellidos'] = ucwords($value);
    }
}
