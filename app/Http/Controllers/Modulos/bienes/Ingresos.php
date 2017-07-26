<?php

namespace App\Http\Controllers\Modulos\bienes;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;
use App\ModPerUser;
use App\User;
use App\Persona;
use App\Empleado;
use App\Modulo;
use Storage;


class Ingresos extends Controller
{

	private $mods;
    private $modulo_id;

	public function __construct($id)
	{
		$this->mods = ModPerUser::getModulos(Auth::user()->id);
        $this->modulo_id = $id;
	}

	public function index(Request $request)
	{
		return view('intranet.bienes.index', ['modulos' => $this->mods]);
	}

}
