<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class GroupsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'groups';

    public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $groups = Group::search($keyword)->paginate(13);
        } else {
            $groups = Group::orderBy('id', 'ASC')->paginate(13);
        }

        return view('groups', [
            'groups' => $groups,
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
            'professors' => User::professors()->get(),
        ]);
    }

    public function show($id){

    }

    public function create(){

    }
    
    public function delete(){

    }

    public function modify(){
    	
    }
}
