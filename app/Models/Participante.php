<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    protected $table = 'competencia.participantes';

    protected $fillable = ['persona_id', 'recibir_sms'];

    public function inscripcion()
    {
    	return $this->hasMany('App\Models\Comp_Part');
    }

    public function persona()
    {
    	return $this->belongsTo('App\Models\Persona');
    }
}
