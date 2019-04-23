<?php
 

use App\Http\Controllers\StudentsController;
use App\Http\Controllers\RequestsRegistryController;
 
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

	//Si el usuario está autenticado redireccionarlo a la home
	if(Auth::check()){ 
		return redirect('/inicio'); 
	} else {
		return view('auth/login', [
			'careers' => App\Career::all()
		]);
	}
}); // Ya cala eso, debe funcionar ya pa irme a dormir alv

Route::get('/acercade', 'PagesController@about')->name('about');

//Alumnos

Route::get('/alumnos/', 'StudentsController@showAll')->name('students')->middleware('auth');
Route::get('/alumnos/{id}', 'StudentsController@show')->middleware('auth');
Route::get('/alumnos/control/{id}', 'StudentsController@showControlNumber')->name('matricula')->middleware('auth');


Route::post('/alumnos/crear', 'StudentsController@create')->middleware('auth');
Route::post('/alumnos/eliminar', 'StudentsController@delete')->middleware('auth');
Route::post('/alumnos/modificar', 'StudentsController@modify')->middleware('auth');


//Grupos

Route::get('/grupos/', 'GroupsController@showAll')->name('groups')->middleware('auth');
Route::get('/grupos/{id}', 'GroupsController@show')->middleware('auth');
Route::get('/grupos/listas/{id}', 'GroupsController@attendanceList')->middleware('auth')->name('attendanceLists');

Route::post('/grupos/crear', 'GroupsController@create')->middleware('auth');
Route::post('/grupos/eliminar', 'GroupsController@delete')->middleware('auth');
Route::post('/grupos/modificar', 'GroupsController@modify')->middleware('auth');
Route::post('/grupos/alternar', 'GroupsController@toggle')->middleware('auth');

Route::post('/grupos/agregar', 'GroupsController@addStudent')->middleware('auth');
Route::post('/grupos/remover', 'GroupsController@removeStudent')->middleware('auth');

//Usuarios

Route::get('/usuarios/', 'UsersController@showAll')->name('users')->middleware('auth');
Route::get('/usuarios/{id}', 'UsersController@show')->middleware('auth');

Route::post('/usuarios/crear','UsersController@create')->middleware('auth');
Route::post('/usuario/modificarContraseña','UsersController@changePassword')->middleware('auth');

// Grupos para maestros

Route::get('/mis-grupos/', 'GroupsController@showOwnedGroups')->name('my-groups')->middleware('auth');
Route::get('/mis-grupos/{id}', 'GroupsController@showOwnedGroup')->middleware('auth');
Route::post('/mis-grupos/actualizar', 'GradesController@updateGrades')->middleware('auth');

Auth::routes();

Route::get('/inicio', 'PagesController@home')->name('home');
Route::get('/test', 'PagesController@test')->name('test');
Route::post('/alumnos/solicitar-registro', 'RequestsRegistryController@requestRegistry');


// TOEFL
Route::get('/toefl/', 'ToeflGroupController@showAll')->name('toefl');
Route::post('/toefl/resultados', 'ToeflGroupController@updateScores')->name('toefl-results')->middleware('auth');
Route::get('/toefl/{id}', 'ToeflGroupController@showGroup')->middleware('auth');
Route::post('/toefl/crear-grupo', 'ToeflGroupController@createToeflGroup')->name('toefl-group')->middleware('auth');
Route::get('/toefl/listas/{id}', 'ToeflGroupController@attendanceList')->middleware('auth')->name('attendanceListsTOEFL');
Route::post('/toefl/modificar', 'ToeflGroupController@modify')->middleware('auth');
Route::post('/toefl/alternar', 'ToeflGroupController@toggle')->middleware('auth');


Route::post('/toefl/eliminar', 'ToeflGroupController@delete')->middleware('auth');
Route::get('/carta-liberacion-toefl/', 'ToeflGroupController@accreditationTOEFL')->name('toefl-accreditation')->middleware('auth');
Route::post('/toefl/agregar', 'ToeflGroupController@addStudent')->middleware('auth');
Route::post('/toefl/remover', 'ToeflGroupController@removeStudent')->middleware('auth');



// Historial
Route::get('/historial/', 'HistoryController@showAll')->name('history')->middleware('auth');

// Configuración
Route::get('/configuracion/', 'SettingsController@showSettings')->name('settings')->middleware('auth');
Route::post('/configuracion/rangos-crear/', 'SettingsController@rangesSetting')->name('rangos')->middleware('auth');
Route::post('/configuracion/carreras-crear', 'SettingsController@createCareer')->middleware('auth');
Route::post('/configuracion/aulas-crear', 'SettingsController@createClassroom')->middleware('auth');


//kardex
Route::get('/kardex/', 'KardexController@showMyKardex')->name('kardex')->middleware('auth');