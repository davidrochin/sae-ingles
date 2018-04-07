<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Role;
use App\Student;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\AddStudentToGroupRequest;
use App\Http\Requests\RemoveStudentFromGroupRequest;
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

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }

        $groups = Group::orderBy('active', 'DESC');

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
                $groups = $groups->where('user_id',4);
                break;
            case 5:
                //Grupos con cupo disponible.
                $groups = Group::has('students','<',function($query){
                    $query->select('capacity');
                });;
                break;
            case 6:
                //Grupos llenos.
                $groups = Group::has('students','>=',function($query){
                    $query->select('capacity');
                });;
                break;
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $groups = $groups->search($keyword);
        } else {
            $groups = $groups->orderBy('active', 'DESC');
        }

        return view('groups', [
            'groups' => $groups->paginate(12),
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
            'professors' => User::professors()->get(),
        ]);
    }

    public function show(Request $request, $id){

        $group = Group::where('id', $id)->first();

        return view('group', [
            'group' => $group,
            'professors' => User::all(),
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
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

        return redirect()->back()->with('success', 'El grupo ha sido creado con éxito.');
    }
    
    public function delete(){

    }

    public function modify(){
    	
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
        //dd($request);
        $group = Group::findOrFail($request->input('groupId'));
        $student = Student::findOrFail($request->input('studentId'));

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

        return redirect()->back()->with('success', $student->last_names.' '.$student->first_names.' fue agregado(a) con éxito al grupo.');
    }

    public function removeStudent(RemoveStudentFromGroupRequest $request){

        $group = Group::findOrFail($request->input('groupId'));
        $student = Student::findOrFail($request->input('studentId'));

        $group->students()->detach($student);

        return redirect()->back()->with('success', 'El alumno se eliminó del grupo con éxito.');
    }
}
