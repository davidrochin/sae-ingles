<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Role;
use App\Student;
use App\Http\Requests\CreateGroupRequest;
use App\Http\Requests\AddStudentToGroupRequest;
use App\Http\Requests\RemoveStudentFromGroupRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;

class GroupsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'groups';

    public function showAll(Request $request){

        //Revisar si hay una keyword en los parametros
        $keyword = $request->get('keyword');

        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }

        //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $groups = Group::search($keyword)->paginate(13);
        } else {
            $groups = Group::orderBy('active', 'DESC')->paginate(13);
        }

        return view('groups', [
            'groups' => $groups,
            'parentRoute' => GroupsController::DEFAULT_PARENT_ROUTE,
            'professors' => User::professors()->get(),
        ]);
    }

    public function show(Request $request, $id){

        $group = Group::where('id', $id)->first();

        return view('group', [
            'group' => $group,
            'professors' => User::professors()->get(),
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

        //Revisar si el alumno ya está en el grupo
        if($student->groups->find($group->id) != null){
            return redirect()->back()->with('message', 'El alumno que usted intentó agregar ya estaba en el grupo.');
        }

        //Agregar el alumno al grupo
        $group->students()->attach($student);

        return redirect()->back()->with('success', 'El alumno fue agregado con éxito al grupo.');
    }

    public function removeStudent(RemoveStudentFromGroupRequest $request){

        $group = Group::findOrFail($request->input('groupId'));
        $student = Student::findOrFail($request->input('studentId'));

        $group->students()->detach($student);

        return redirect()->back()->with('success', 'El alumno se eliminó del grupo con éxito.');
    }
}
