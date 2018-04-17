<?php

namespace App\Http\Controllers;

use App\Student;
use App\Career;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'students';

    //public function showAll(){
    public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');
        $filter = $request->get('filter');
        $order = $request->get('order');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        //dd(Auth::user()->roles);
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }

        $students = Student::orderBy('id', 'ASC');

        //Ordenar si es necesario
        switch ($order){
            case 1:
                //Ordenar por estado
                
                break;
            case 2:
                //Ordenar por ID
                $students = Student::orderBy('id', 'ASC');
                break;
            case 3:
                //Ordenar por apellidos
                $students = Student::orderBy('last_names', 'ASC');
                break;
            case 4:
                //Ordenar por Carrera
                $students = Student::join('careers', 'students.career_id', '=', 'careers.id')->orderBy('students.career_id', 'DESC');
                break;
        }

        //Filtrar si es necesario
        switch ($filter) {
            case 1:
                //$students = $students->orderBy('id', 'DESC');
                break;
            case 2:
                //Mandar solo alumnos sin grupos activos
                $students = $students->whereDoesntHave('groups', function($query){
                    $query->where('active', 1);
                });
                break;
            default:
                //$students = $students->orderBy('id', 'DESC');
                break;
        }


        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $students = $students->search($keyword);
        }

        $careers = Career::all();

        //Para mandar un mensaje al usuario
        //$request->session()->now('message', 'Prueba de mensaje');

    	return view('students', [
    		'students' => $students->paginate(12),
            'careers' => $careers,
            'parentRoute' => StudentsController::DEFAULT_PARENT_ROUTE,
            //'modalMessage' => 'Prueba de modal de mensajes',
    	]);
    }

    public function show(Request $request, $id){
        $careers = Career::all();
        $student = Student::findOrFail($id);

        //Revisar si se pidió en JSON
        if($request->get('json') == 1){
            return response()->json($student);
        }

        //if(!$student){abort(404);}

        return view('student', [
            'student' => $student,
            'careers' => $careers,
            'parentRoute' => StudentsController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    public function create(CreateStudentRequest $request){

    	//Vardump de los datos del request
    	//dd($request->all());

    	//$this->validate($request);

        $user = $request->user();

    	$student = Student::create([
    		'control_number' => $request->input('controlNumber'),
    		'career_id' => $request->input('careerId'),
    		'first_names' => $request->input('firstNames'),
    		'last_names' => $request->input('lastNames'),
    		'phone_number' => $request->input('phoneNumber'),
    		'email' => $request->input('email')
    	]);
        $careers = Career::all();

    	//dd($student);

    	//return redirect('/alumnos/'.$messages->id);
        $request->flash();

    	return redirect()->back()->with('success', 'El alumno ha sido creado con éxito.');
        //return redirect('alumnos/'.$student->id.'/');
    }

    public function delete(DeleteStudentRequest $request){

        //dd($request->all());
        //dd($request->all());

        $student = Student::find($request->input('id'));
        $student->delete();

        //return redirect('/alumnos/');
        return redirect('/alumnos')->with('success', 'El alumno ha sido eliminado con éxito.');
    }

    public function modify(ModifyStudentRequest $request){

        //Buscar el alumno que se está modificando
        $student = Student::find($request->input('id'));

        //Reemplazar los datos del alumno
        $student->control_number = $request->input('controlNumber');
        $student->first_names = $request->input('firstNames');
        $student->last_names = $request->input('lastNames');
        $student->career_id = $request->input('careerId');
        $student->phone_number = $request->input('phoneNumber');
        $student->email = $request->input('email');

        //Guardar los cambios
        $student->save();

        return redirect()->back();
    }
}
