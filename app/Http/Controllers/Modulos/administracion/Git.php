<?php

namespace App\Http\Controllers\Modulos\administracion;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\ModPerUser;
use App\User;

use App\Modulo;

class Git extends Controller
{
   	/**
	 * $mods array de modulos a los que el usuario
	 * tiene permisos
	 * @var array
	 */
	private $mods;

	/**
	 * $modulo_id  id del modulo al que el usuario tiene permisos
	 * @var integer
	 */
    private $modulo_id;

	public function __construct($id = 0)
	{
		if($id != 0)
		{
			$this->mods = ModPerUser::getModulos(Auth::user()->id);
        	$this->modulo_id = $id;
        }
	}

	public function index(Request $request){

		return view('intranet.administracion.index', [
			'modulos' => $this->mods,
		]);
	}

	public function setRepository(Request $request){
		
	}
}
