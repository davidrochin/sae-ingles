<?php


use App\Http\Controllers\StudentsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

	//Si el usuario está autenticado redireccionarlo a una sección cualquiera
	if(Auth::check()){ 
		return redirect('/alumnos'); 
	} 
	else {
		return view('auth/login'); 
	}

});

Route::get('/about', function() { return 'Acerca de nosotros'; });

Route::get('/alumnos', 'StudentsController@show')->name('alumnos');

Route::post('/alumnos/crear', 'StudentsController@create');

Route::post('/alumnos/eliminar', 'StudentsController@delete');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
