<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;


class UsersController extends Controller
{
    
    const DEFAULT_PARENT_ROUTE = 'users';

	public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin','coordinator'])){
            return view('auth.nopermission');
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $users = User::search($keyword)->paginate(13);
        } else {
            $users = User::orderBy('id', 'ASC')->paginate(13);
        }

        if (Auth::user()->hasRole('admin')) {
            $roles = Role::all();
        }else{
            $roles = Role::where('name','professor')->get();
        }
        


    	return view('users', [
    		'users' => $users,
            'roles' => $roles,
            'parentRoute' => UsersController::DEFAULT_PARENT_ROUTE,
    	]);
    }

    public function show($id){
        dd(User::where('id', $id)->first());
    }

    public function create(CreateUserRequest $request){

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password_new')),
            'role_id' => $request->input('roleId'),
        ]);

        //Esta linea es para que se manden los datos de vuelta a la view y se puedan volver a poner en sus respectivos Inputs.
        //(Así el usuario no tiene que volver a ingresar los datos que sí estaban bien).
        $request->flash();

        return redirect()->back()->with('success', 'El usuario ha sido creado con éxito.');
    }

}
