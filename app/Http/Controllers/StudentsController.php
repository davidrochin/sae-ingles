<?php

namespace App\Http\Controllers;

use App\Student;
use App\Career;
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

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        //dd(Auth::user()->roles);
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $students = Student::search($keyword)->paginate(13);
        } else {
            $students = Student::orderBy('id', 'ASC')->paginate(13);
        }

        $careers = Career::all();

    	return view('students', [
    		'students' => $students,
            'careers' => $careers,
            'parentRoute' => StudentsController::DEFAULT_PARENT_ROUTE,
    	]);
    }

    public function show($id){

        $careers = Career::all();
        $student = Student::findOrFail($id);

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
