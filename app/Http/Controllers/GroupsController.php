<?php

namespace App\Http\Controllers;
  
use App\Group;
use App\Http\Requests\DeleteGroupRequest;
use App\Http\Requests\ModifyGroupRequest;
use App\User;
use App\Role;
use App\Student;
use App\Classroom;
use App\Grade;
use App\History;

use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\AddStudentToGroupRequest;
use App\Http\Requests\RemoveStudentFromGroupRequest;
use App\Http\Requests\ToggleGroupStateRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator; 
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
use function Sodium\add;

class GroupsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'groups';
   


    public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');
        $filter = $request->get('filter');
        $order = $request->get('order');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }

        //$groups = Group::orderBy('active', 'DESC');
        $groups = Group::orderBy('id', 'DESC');

        //Ordenar si es necesario
        switch ($order){
            case 1:
                //Ordenar por ID
                $groups = Group::orderBy('id', 'DESC');
                break;
            case 2:
                //Ordenar por estado
                $groups = Group::orderBy('active', 'DESC')->orderBy('id', 'ASC');
                break;
            case 3:
                //Ordenar por nombre
                $groups = Group::orderBy('name', 'ASC');
                break;
            case 4:
                //Ordenar por nivel
                $groups = Group::orderBy('level', 'DESC');
                break;
            case 5:
                //Ordenar por año
                $groups = Group::orderBy('year', 'DESC');
                break;
            case 6:
                //Ordenar por periodos
                $groups = Group::orderBy('period_id', 'ASC');
                break;
        }

        //Filtrar
        switch ($filter){
            case 1:

                break;
            case 2:
                //Mandar solo grupos activos
                $groups = $groups->where('active',1);
                break;
            case 3:
                //Mandar solo grupos inactivo
                $groups = $groups->where('active',0);
                break;
            case 4:
                //Grupos que no tienen profesor asignado.
                $groups = $groups->where('user_id', null);
                break;
            case 5:
                //Grupos con cupo disponible.
                $groups = Group::has('students','<',function($query){
                    $query->select('capacity');
                });
                break;
            case 6:
                //Grupos llenos.
                $groups = Group::has('students','>=',function($query){
                    $query->select('capacity');
                });
                break;
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $groups = $groups->search($keyword);
        } /*else {
            $groups = $groups->orderBy('active', 'DESC');
        }*/

        return view('groups', [
            'groups' => $groups->paginate(12),
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
            'professors' => User::professors()->get(),
        ]);
    }

    public function show(Request $request, $id){

        $group = Group::where('id', $id)->first();
        $grades = $group->getGrades();
        $averages = $group->getAverages();
        //dd($grades);

        return view('group', [
            'group' => $group,
            'grades' => $grades,
            'classrooms' => Classroom::all(),
            'averages' => $averages,
            'professors' => User::all(),
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    public function showOwnedGroups(Request $request){
         if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }
        $groups = Group::where('user_id', Auth::user()->id)->orderBy('period_id', 'ASC');
        

        return view('my-groups', [
            'groups' => $groups->paginate(12),
            'parentRoute' => 'my-groups',
            'professors' => User::professors()->get()
        ]);
    }

    public function showOwnedGroup(Request $request, $id){

        
        $user = Auth::user();
        $group = Group::where('id', $id)->first();

        //Revisar si el usuario es profesor del grupo
        if($group->user->id != $user->id){
            return view('auth.nopermission', [
                'permissionMessage' => 'Usted no está registrado como profesor de este grupo.'
            ]);
        }

        $grades = Grade::where('group_id', $id)->get(); 
        $grades->sortBy(function($group){ return $group->student->last_names; });

        $gradesTable = array();

        foreach ($grades as $key => $grade) {

            //Si no existe un renglon para ese estudiante, crearlo
            if(!array_key_exists($grade->student_id, $gradesTable)){
                $gradesTable[$grade->student_id] = array();
            }

            //Insertar el score del estudiante
            $gradesTable[$grade->student_id][$grade->partial] = $grade->score;

        }
        //dd($gradesTable);

        //Preparar los promedios
        $averages = array();
        foreach ($gradesTable as $key => $value) {
            $averages[$key] = Student::find($key)->getAverage($group->id);
        }

        $capture=true;
        if($group->active == 1){
             $capture=true;
        }else{
             $capture=false;
        }


        return view('my-group', [
            'group' => $group,
            'capture' => $capture,
            'professors' => User::all(),
            'parentRoute' => 'my-groups',
            'gradesTable' => $gradesTable,
            'averages' => $averages,
        ]);
    }
 
    public function create(CreateGroupRequest $request){
        Group::create([
            'name' => $request->input('name'),
            'code' => $request->input('code'),
            'level' => $request->input('level'),
            'user_id' => $request->input('professorId'),
            'schedule_start' => $request->input('scheduleStart'),
            'schedule_end' => $request->input('scheduleEnd'),
            'days' => implode($request->input('days')),
            'year' => $request->input('year'),
            'period_id' => $request->input('periodId'),
            'classroom_id' => $request->input('classroomId'),
        ]);
          // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha creado el grupo '.$request->input('code')
        ]);

        return redirect()->back()->with('success', 'El grupo ha sido creado con éxito.');
    }
    
    public function delete(DeleteGroupRequest $request){

        $group = Group::findOrFail($request->input('idGroup'));
        $students = $group->students;
        $grades = $group->grades;

        //Borrar todas las calificaciones de este grupo
        foreach ($grades as $grade) {
            $grade->delete();
        }

        //Desasignar todos los alumnos de este grupo
        foreach ($students as $student){
            $group->students()->detach($student);
        }

        $group->delete();
          // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha eliminado el grupo ID: '.$request->input('idGroup')
        ]);

        return redirect('/grupos/')->with('success', 'El grupo ha sido eliminado con éxito.');
    }

    public function modify(ModifyGroupRequest $request){
        $group =  Group::where('id',$request->input('idGroup'))->first();
       
        if($group->active == 1){
          
                Group::where('id',$request->input('idGroup'))
                    ->update(['name' => $request->input('name'),
                    'code' => $request->input('code'),
                    'capacity' => $request->input('capacity'),
                    'level' => $request->input('level'),
                    'period_id' => $request->input('periodId'),
                    'year' => $request->input('year'),
                    'user_id' => $request->input('professorId'),
                    'schedule_start' => $request->input('scheduleStart'),
                    'schedule_end' => $request->input('scheduleEnd'),
                    'classroom_id' => $request->input('classroomId'),
                    'days' => implode($request->input('days'))
                    ]);
                // Registrar la acción en el historial
                History::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'ha modificado el grupo '.$request->input('code')
                ]);
                 $group->save();

                return redirect()->back()->with('success','El grupo ha sido modificado con éxito');
        } else {
                return redirect()->back()->with('message','El grupo se encuentra cerrado');
        }
       
    }

    public function toggle(ToggleGroupStateRequest $request){
        $group = Group::find($request->input('groupId'));
        $successMessage = '';

        if($group->active == 1){
            $group->active = 0;
            $successMessage = 'El grupo se ha cerrado con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha desactivado el grupo ID: '.$request->input('groupId')
        ]);
        } else {
            $group->active = 1;
            $successMessage = 'El grupo se ha abierto con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha activado al grupo ID: '.$request->input('groupId')
        ]);
        }
        $group->save();

        return redirect()->back()->with('success', $successMessage);
    }

    public function attendanceList(Request $request, $id){
        $group = Group::findOrFail($id);
        $students = $group->students;

        return view('attendance-list', [
            'group' => $group,
            'students' => $students,
            'attendanceSlots' => 22,
        ]);
    }

    public function addStudent(AddStudentToGroupRequest $request){
            $group = Group::find($request->input('groupId'));
            $student = Student::where('control_number',$request->input('studentId'))->first();
             
            if($group->active == 1){
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
                  
           
            } else {
                return redirect()->back()->with('message', 'El grupo se encuentra cerrado.');
            
            }
            $group->save();  
    }

    public function removeStudent(RemoveStudentFromGroupRequest $request){
        $group = Group::find($request->input('groupId'));
        $student = Student::findOrFail($request->input('studentId'));
         
        if($group->active == 1){
            
            $group->students()->detach($student);
                     // Registrar la acción en el historial
            History::create([
                'user_id' => Auth::user()->id,
                'description' => 'ha eliminado al alumno ID:'.$request->input('studentId').' al grupo ID: '.$request->input('groupId')
            ]);
        return redirect()->back()->with('success', 'El alumno se eliminó del grupo con éxito.');
       
        } else {
            return redirect()->back()->with('message', 'El grupo se encuentra cerrado.');
        
        }
        $group->save();  
       
    }

}
