<?php

namespace App\Http\Controllers;
 

use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Student;
use Illuminate\Http\Request;

class KardexController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'kardex';

       public function showMyKardex(Request $request){
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
       if(!Auth::user()->hasAnyRole(['admin', 'student'])){ //es solo para alumnos por pero por pruebas se deja para admin tambien
            return view('auth.nopermission');
        }
       
        return view('kardex', [
    
            'parentRoute' => KardexController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    

}
