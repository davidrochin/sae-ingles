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
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator', 'schoolserv'])){
            return view('auth.nopermission');
        }

        $students = Student::orderBy('id', 'DESC');

        //Ordenar si es necesario
        switch ($order){
            case 1:
                //Ordenar por ID
                $students = Student::orderBy('id', 'DESC');
                break;
            case 2:
                //Ordenar por estado
                /*$students = Student::with(['student_group' => function($query){
                    $query
                }]]);*/
                break;
            case 3:
                //Ordenar por apellidos
                $students = Student::orderBy('last_names', 'ASC');
                break;
            case 4:
                //Ordenar por Carrera
                //$students = Student::join('careers', 'students.career_id', '=', 'careers.id')->orderBy('students.career_id', 'DESC');
                $students = Student::orderBy('students.career_id', 'DESC');
                break;
        }

        //Filtrar si es necesario
        switch ($filter) {
            case 1:
                //$students = $students->orderBy('id', 'DESC');
                break;
            case 2:
                //Mandar solo alumnos sin grupos activos
                $students = $students->whereHas('groups', function($query){
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

        $user = $request->user();

    	$student = Student::create([
    		'control_number' => $request->input('controlNumber'),
    		'career_id' => $request->input('careerId') == 0 ? NULL : $request->input('careerId'),
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

        $student = Student::find($request->input('id'));
        $groups = $student->groups;

        //Desasignar el alumno de todos los grupos
        foreach ($groups as $group) {
            $student->groups()->detach($group);
        }

        $student->delete();

        return redirect('/alumnos')->with('success', 'El alumno ha sido eliminado con éxito.');
    }

    public function modify(ModifyStudentRequest $request){

        Student::where('id',$request->input('id'))
            ->update(['first_names' => $request->input('firstNames'),
                'last_names' => $request->input('lastNames'),
                'career_id' => $request->input('careerId'),
                'phone_number' => $request->input('phoneNumber'),
                'email' => $request->input('email')
            ]);


        return redirect()->back()->with('success','El alumno ha sido modificado con éxito');
    }

    // Falta crear un request personalizado para que se valide sin tanta lógica
    public function requestRegistry(Request $request) {

        $user = $request->user();

    	$student = Student::create([
    		'control_number' => $request->input('controlNumber'),
    		'career_id' => $request->input('careerId') == 0 ? NULL : $request->input('careerId'),
    		'first_names' => $request->input('firstNames'),
    		'last_names' => $request->input('lastNames'),
    		'phone_number' => $request->input('phoneNumber'),
    		'email' => $request->input('email')
    	]);
        $careers = Career::all();

    	//dd($student);

    	//return redirect('/alumnos/'.$messages->id);
        $request->flash();


        return redirect()->back()->with('success', 'La solicitud ha sido enviada con éxito.');
    }

//muestra los alumnos con solicitud para ingresar al sistema
       public function showStudentsRequests(Request $request){

       
        return view('students-requests', [
          
            'parentRoute' => StudentsController::DEFAULT_PARENT_ROUTE,
        ]);
    }


}
