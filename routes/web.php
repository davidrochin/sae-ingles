<?php

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

	//$appname = 'Departamento de Gestión Tecnológica y Vinculación';
	/*$messages = [
		['id' => 1, 'content' => 'Este es un mensaje de prueba', 'image' => 'http://lorempixel.com/600/338?1'],
		['id' => 2, 'content' => 'Este es otro mensaje de prueba', 'image' => 'http://lorempixel.com/600/338?2'],
		['id' => 3, 'content' => 'Este es otro mensaje de prueba', 'image' => 'http://lorempixel.com/600/338?3'],
		['id' => 4, 'content' => 'Este es otro mensaje de prueba', 'image' => 'http://lorempixel.com/600/338?4']
	];*/

	return view('login'); 
});

Route::get('/about', function() { return 'Acerca de nosotros'; });

Route::get('/alumnos', 'StudentsController@show');

Route::post('/alumnos/crear', 'StudentsController@create');
