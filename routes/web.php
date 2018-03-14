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

	//Si el usuario está autenticado redireccionarlo a la home
	if(Auth::check()){ 
		return redirect('/home'); 
	} else {
		return view('auth/login'); 
	}

});

Route::get('/about', function() { return 'Desarrollado por David Rochín.'; });

//Alumnos

Route::get('/alumnos/', 'StudentsController@showAll')->name('students')->middleware('auth');;
Route::get('/alumnos/{id}', 'StudentsController@show')->middleware('auth');;

Route::post('/alumnos/crear', 'StudentsController@create')->middleware('auth');
Route::post('/alumnos/eliminar', 'StudentsController@delete')->middleware('auth');
Route::post('/alumnos/modificar', 'StudentsController@modify')->middleware('auth');

//Grupos

Route::get('/grupos/', 'GroupsController@showAll')->name('groups')->middleware('auth');
Route::get('/grupos/{id}', 'GroupsController@show')->middleware('auth');

Route::post('/grupos/crear', 'GroupsController@create')->middleware('auth');
Route::post('/grupos/eliminar', 'GroupsController@delete')->middleware('auth');
Route::post('/grupos/modificar', 'GroupsController@modify')->middleware('auth');

//Usuarios

Route::get('/usuarios/', 'UsersController@showAll')->name('users')->middleware('auth');
Route::get('/usuarios/{id}', 'UsersController@show')->middleware('auth');

Auth::routes();

Route::get('/home', 'PagesController@home')->name('home');

/*Route::group(['middleware' => 'auth'], function () {

    // All my routes that needs a logged in user

}

// All my routes that need no authentication*/