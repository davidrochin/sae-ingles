<?php

namespace App\Http\Controllers;
 
use App\Student;
use App\Career;
use App\ToeflGroup;
use App\User;
use App\Classroom;
use App\History;
use App\Util;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\AddStudentToGroupRequest;
use App\Http\Requests\RemoveStudentFromGroupRequest;
use App\Http\Requests\ModifyStudentRequest;
use App\Http\Requests\ModifyToeflRequest;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use PDF;
use function Sodium\add;
 
class ToeflGroupController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'toefl';


//se tiene que validar que se muestre si se cumplio con el requisito de puntos
    public function accreditationTOEFL(){
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('America/Mazatlan');
$numero=date('Y');
$texto=Util::convertir($numero);
$year = ucfirst($texto);
  
$fecha= strftime("%d días del mes de %B del año ".$year);
$student=Student::where('user_id',Auth::user()->id)->first();
 $careers = Career::all();
        return view('accreditation-toefl', [
          'fecha' => $fecha,
          'career' => $careers,
          'student' => $student,
            'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
           
        ]);
    }


    public function showAll(Request $request){

     
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }

        //$groups = Group::orderBy('active', 'DESC');
        $groups = ToeflGroup::orderBy('id', 'DESC');


 

         return view('toefl', [
          'groups' => $groups->paginate(12),
          'professors' => User::professors()->get(),
          'classrooms' => Classroom::all(),
          'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
            
        ]);
    }

 
     public function showGroup(Request $request, $id){
        $group = ToeflGroup::where('id', $id)->first();
      
        return view('toefl-group', [
            'group' => $group,
            'professors' => User::all(),
            'classrooms' => Classroom::all(),
            'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
        ]);

     }
   
    public function createToeflGroup(Request $request){

 ToeflGroup::create([
            
            'responsable_user_id' => $request->input('aplicadorId'),
            'applicator_user_id' => $request->input('responsableId'),
            'applicator_user_id' => $request->input('responsableId'),
            'capacity' => $request->input('capacity'),
            'applied' => false,
            'date' => $request->input('date'),
            'classroom_id' => $request->input('classroomId'),
            'time' => $request->input('time'),
            
        ]);
          // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha creado el grupo TOEFL'
        ]);

        return redirect()->back()->with('success', 'El grupo TOEFL ha sido creado con éxito.');
    }

  public function attendanceList(Request $request, $id){
        $group = ToeflGroup::findOrFail($id);
        $students = $group->students;

        return view('attendance-toefl-list', [
            'group' => $group,
            'students' => $students,
            'attendanceSlots' => 22,
        ]);
    }
 
    public function addStudent(AddStudentToGroupRequest $request){
        //dd($request);
        $group = ToeflGroup::find($request->input('groupId'));
        $student = Student::find($request->input('studentId'));

        //Revisar que el grupo tenga capacidad para un nuevo alumno
        if(count($group->students)>=$group->capacity){
            return redirect()->back()->with('message','El grupo ya se encuentra lleno.');
        }

        //Revisar si el alumno ya está en el grupo
        if($student->groups->find($group->id) != null){
            return redirect()->back()->with('message', 'El alumno que usted intentó agregar ya estaba en el grupo.');
        }

        //Agregar el alumno al grupo
        $group->students()->attach($student);

         // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha ingresado al alumno ID :'.$request->input('studentId').' al grupo ID: '.$request->input('groupId')
        ]);

        return redirect()->back()->with('success', $student->last_names.' '.$student->first_names.' fue agregado(a) con éxito al grupo.');
    }

    public function removeStudent(RemoveStudentFromGroupRequest $request){

        $group = ToeflGroup::findOrFail($request->input('groupId'));
        $student = Student::findOrFail($request->input('studentId'));

        $group->students()->detach($student);
                 // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha eliminado al alumno ID:'.$request->input('studentId').' al grupo ID: '.$request->input('groupId')
        ]);
        return redirect()->back()->with('success', 'El alumno se eliminó del grupo con éxito.');
    }

 public function modify(Request $request){
      
        ToeflGroup::where('id',$request->input('idGroup'))
            ->update(['date' => $request->input('date'),
            'time' => $request->input('time'),
            'capacity' => $request->input('capacity'),
            'classroom_id' => $request->input('classroomId'),
            'responsable_user_id' => $request->input('responsableId'),
            'applicator_user_id' => $request->input('applicatorId'),
           
            ]);
  // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha modificado el grupo TOEFL'.$request->input('idGroup')
        ]);

        return redirect()->back()->with('success','El grupo ha sido modificado con éxito');
    }

  public function delete(Request $request){

        $group = ToeflGroup::findOrFail($request->input('idGroup'));
        $students = $group->students;
        $grades = $group->grades;

       

        //Desasignar todos los alumnos de este grupo
        foreach ($students as $student){
            $group->students()->detach($student);
        }

        $group->delete();
          // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha eliminado el grupo TOEFL ID: '.$request->input('idGroup')
        ]);

        return redirect('/grupos/')->with('success', 'El grupo ha sido eliminado con éxito.');
    }
}
