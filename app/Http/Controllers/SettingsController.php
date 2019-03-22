<?php

namespace App\Http\Controllers;
 

use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Career;
use App\Classroom;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'settings';


       public function showSettings(Request $request){
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }

       
        return view('settings', [
            'careers' => Career::all(),
            'classrooms'=> Classroom::all(),
            'parentRoute' => SettingsController::DEFAULT_PARENT_ROUTE,
        ]);
    }

       public function createCareer(Request $request){


        $student = Career::create([
          
            'name' => $request->input('name'),
            'short_name' =>  $request->input('short_name'),
        ]);
       
       return redirect()->back()->with('success', 'La carrera ha sido creada con éxito.');
    }

}
