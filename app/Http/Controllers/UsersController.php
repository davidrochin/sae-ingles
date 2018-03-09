<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    
	public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasRole('admin')){
            return view('auth.nopermission');
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $users = User::search($keyword)->paginate(13);
        } else {
            $users = User::orderBy('id', 'ASC')->paginate(13);
        }

    	return view('users', [
    		'users' => $users
    	]);
    }

}
