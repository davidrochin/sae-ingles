<?php

namespace App\Http\Controllers;

use App\Student;
use App\Career;
use App\History;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
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
    public function requestRegistry(Request $request) {

        $user = $request->user();

        
        $now=date('Y');
        $year=substr($now, 2);
        $folioanterior= User::select('id')->orderby('created_at','DESC')->first(); //CONSULTA  ultimo id de tabla users 
        $folio=substr($folioanterior, -3, 2)+1; //extrae solo el numero de {"id":51} +1 lo correcto es no recortarlo ya que cuando sean mas de 100 habra problemas que se repitan
        $foliocompleto = str_pad($folio, 4, "0", STR_PAD_LEFT);
                $numcontrol=$year.'00'.$foliocompleto;


    
        $student = Student::create([
            'control_number' => $numcontrol,//$request->input('controlNumber'), //aqui solo guarda el num control que se genera para externos falta validar que cuando se seleccione internos se guarde el que se ingreso en el inputtext como estaba anteriormente
            'career_id' => $request->input('careerId') == 0 ? NULL : $request->input('careerId'),
            'first_names' => $request->input('firstNames'),
            'last_names' => $request->input('lastNames'),
            'phone_number' => $request->input('phoneNumber'),
            'email' => $request->input('email'),
            
           
        ]);

         User::create([
            'name' => $request->input('firstNames').' '.$request->input('lastNames'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role_id' => 1,
         
        ]);

        $careers = Career::all();

        $request->flash();



     return redirect()->back()->with('success', 'La solicitud ha sido enviada con éxito.');
    }
 
    // Muestra los alumnos con solicitud para ingresar al sistema
    public function showStudentsRequests(Request $request){

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }

        // Este metodo va en otro controlador que sea Solicitudescontroller
        return view('students-requests', [
            'parentRoute' => RequestsRegistryController::DEFAULT_PARENT_ROUTE,
        ]);
    }


 
}




 

       

