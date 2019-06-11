<?php

namespace App\Http\Controllers;

use App\Student;
use App\Career;
use App\History;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\RegistryRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Carbon;
use App\User;
use App\Role;
use App\Http\Requests\CreateUserRequest;


class RequestsRegistryController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'students-requests';
   // Falta crear un request personalizado para que se valide sin tanta lógica
    public function requestRegistry(RegistryRequest $request) {

      
        $user = $request->user();

            $user= User::create([
                    'name' => $request->input('firstNames').' '.$request->input('lastNames1').' '.$request->input('lastNames2'),
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password')),
                    'role_id' => 1,
                 
                ]);
 

        $now=date('Y');
        $year=substr($now, 2);
        $folioanterior= User::select('id')->orderby('created_at','DESC')->first(); //CONSULTA  ultimo id de tabla users 
        $folio=$folioanterior->id;
        $foliocompleto = str_pad($folio, 4, "0", STR_PAD_LEFT);
        $numcontrol=$year.'00'.$foliocompleto;
        
        if($request->input('origen')=='ext'){

                  $student = Student::create([
                    'control_number' => $numcontrol,//$request->input('controlNumber'), //aqui solo guarda el num control que se genera para externos falta validar que cuando se seleccione internos se guarde el que se ingreso en el inputtext como estaba anteriormente
                    'career_id' => $request->input('careerId') == 0 ? NULL : $request->input('careerId'),
                    'first_names' => $request->input('firstNames'),
                    'last_names' => $request->input('lastNames1').' '.$request->input('lastNames2'),
                    'phone_number' => $request->input('phoneNumber'),
                    'email' => $request->input('email'),
                    'active' => false,
                 
                   
                ]);
               $student->user()->associate($user);
               $student->save();


        }else{

                  $student = Student::create([
                    'control_number' => $request->input('controlNumber'),//$request->input('controlNumber'), //aqui solo guarda el num control que se genera para externos falta validar que cuando se seleccione internos se guarde el que se ingreso en el inputtext como estaba anteriormente
                    'career_id' => $request->input('careerId') == 0 ? NULL : $request->input('careerId'),
                    'first_names' => $request->input('firstNames'),
                    'last_names' => $request->input('lastNames1').' '.$request->input('lastNames2'),
                    'phone_number' => $request->input('phoneNumber'),
                    'email' => $request->input('email'),
                    'active' => false,
                   
                ]);
                  $student->user()->associate($user);
                  $student->save();

        }
     

             

        $careers = Career::all();

        $request->flash();


     return redirect()->back()->with('success', 'La solicitud ha sido enviada con éxito.');
    }
 

}
/*
$student->user()->associate($user);
$student->save();

*/
 

       

