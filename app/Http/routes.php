<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/prueba', function(){
	return 'Hola mundo';
});

Route::get('/', function (Illuminate\Http\Request $request){

	
	$redirect = function($to){
		return redirect()->to($to);
	};

	if(!\Auth::check())
		return $redirect($request->url().'/index.php/login');

	return $redirect($request->url().'/index.php/dashboard');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/usuarios', 'Usuarios@index');

Route::group(['middleware' => 'auth'], function(){
	
	Route::group(['prefix' => 'dashboard'], function(){
		Route::get('/','intranet\Dashboard@index');
		Route::get('/{modulo}/{programa?}/{accion?}/{id?}', 'intranet\Dashboard@modulo');
		Route::post('/{modulo}/{programa?}/{accion?}/{id?}', 'intranet\Dashboard@modulo');
	});
	
});

Route::group(['prefix' => 'login/corpoz'], function(){

	Route::get('/verificar/{cedula?}', 'intranet\Corpoz@verificar');
	Route::post('/crear', 'intranet\Corpoz@crear');

});

Route::group(['prefix' => 'api'], function(){

	Route::resource('competencia', 'api\competencias\CompetenciaApiController');
});

Route::get('/pruebaAngular', function(){
 	return view('intranet.carrera.angular');
});

Route::get('/comprobante', 'Modulos\competencia\Reportes@verComprobante');