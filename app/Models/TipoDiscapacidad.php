<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoDiscapacidad extends Model
{
    protected $table = 'tipos_discapacidades';
    protected $fillable = ['nombre_tipo', 'codigo_tipo'];


    public function discapacidades()
    {
    	return $this->hasMany('App\Models\Discapacidades', 'tip_disc_id');
    }

}
