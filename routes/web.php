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

/*Route::any('/{route}', function($route) {
    //
    if(Auth::check()){
    	return redirect('/'.$route);
    } else {
    	return redirect('/login');
    }
});*/

Route::get('/', function () {

	//Si el usuario está autenticado redireccionarlo a una sección cualquiera
	if(Auth::check()){ 
		return redirect('/home'); 
	} else {
		return view('auth/login'); 
	}

});

Route::get('/about', function() { return 'Acerca de nosotros'; });

Route::get('/alumnos/', 'StudentsController@showAll')->name('alumnos');

Route::get('/alumnos/{id}', 'StudentsController@show');

Route::post('/alumnos/crear', 'StudentsController@create')->middleware('auth');

Route::post('/alumnos/eliminar', 'StudentsController@delete')->middleware('auth');

Route::post('/alumnos/modificar', 'StudentsController@modify')->middleware('auth');

Auth::routes();

Route::get('/home', 'PagesController@home')->name('home');
