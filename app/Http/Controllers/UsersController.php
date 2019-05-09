<?php

namespace App\Http\Controllers;

use App\Http\Requests\ModifyUserPasswordRequest;
use App\User;
use App\Role;
use App\History;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use function foo\func;


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
            $users = User::searchName($keyword)->paginate(12);
        } else {
            $users = User::orderBy('id', 'ASC')->paginate(12);
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
        //dd(User::where('id', $id)->first());

        $user = User::findOrFail($id);
   
        return view('user', [
            'user' => $user,
            'parentRoute' => UsersController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    

    public function create(CreateUserRequest $request){

        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => $request->input('roleId'),
        ]);
           
        // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha registrado al usario '.$request->input('name')
        ]);

        //Esta linea es para que se manden los datos de vuelta a la view y se puedan volver a poner en sus respectivos Inputs.
        //(Así el usuario no tiene que volver a ingresar los datos que sí estaban bien).
        $request->flash();

        return redirect()->back()->with('success', 'El usuario ha sido creado con éxito.');
    }

    public function changePassword(ModifyUserPasswordRequest $request){
	    User::where('id',$request->input('userId'))
            ->update(['password' => bcrypt($request->input('newPassword'))]);
       
        // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha cambiado la contraseña al usuario ID: '.$request->input('userId')
        ]);
	    return redirect()->back()->with('success','La contraseña ha sido modificada con éxito');

    }

    public function modify(Request $request){
    
      $user = User::where('id', $request->input('iduser'))->first();
    
          
                User::where('id',$request->input('iduser'))
                    ->update(['name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'role_id' => $request->input('role')
                    ]); 
                ;
         
                // Registrar la acción en el historial
                History::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'ha modificado el usuario ID: '.$request->input('iduser')
                ]);
            

        return redirect()->back()->with('success','El usuario ha sido modificado con éxito');
     }

    
    public function delete(Request $request){
 $user = User::find($request->input('iduser'));
        $successMessage = '';

        if($user->active == 1){
            $user->active = 0;
            $successMessage = 'El usuario se ha desactivado con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha desactivado al usuario ID: '.$request->input('iduser')
        ]);
        } else {
            $user->active = 1;
            $successMessage = 'El usuario se ha activado con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha activado al usuario ID: '.$request->input('iduser')
        ]);
        }
        $user->save();

        return redirect()->back()->with('success', $successMessage);
    }

}
