<?php

namespace App\Http\Controllers;
 
use App\Student;
use App\Career;
use App\ToeflGroup;
use App\User;
use App\Classroom;
use App\History;
use App\StudentToeflGroup; 
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

    public function accreditationTOEFL(Request $request,$id){
      
         $student = Student::findOrFail($id);
       //  $groupstoefl = StudentToeflGroup::where('student_id',$student->id)->get();
        

           setlocale(LC_ALL,"es_ES");
                    date_default_timezone_set('America/Mazatlan');
                    $numero=date('Y');
                    $texto=Util::convertir($numero);
                    $year = ucfirst($texto);
                      
                    $fecha= strftime("%d días del mes de %B del año ".$year);
                   
      

                return view('accreditation-toefl', [
                  'fecha' => $fecha,
              //    'groupstoefl' => $groupstoefl,
                  'career' => Career::all(),
                  'student' => $student,
                    'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
                   
                ]);
        
            //  return redirect()->back()->with('message', 'No tiene ningún test TOEFL aplicado, o no lo pudo acreditar. Comunicarse con algún coordinador.');
         

      
            }


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
            $groups = ToeflGroup::orderBy('id', 'DESC');


              //Ordenar si es necesario
              switch ($order){
                  case 1:
                      //Ordenar por ID
                      $groups = ToeflGroup::orderBy('id', 'DESC');
                      break;
                  case 2:
                      //Ordenar por estado
                      $groups = ToeflGroup::orderBy('applied', 'ASC')->orderBy('id', 'ASC');
                      break;
                  case 3:
                      //Ordenar por fecha
                      $groups = ToeflGroup::orderBy('date', 'DESC');
                      break;
                 
              }

              //Filtrar
              switch ($filter){
                  case 1:

                      break;
                  case 2:
                      //Mandar solo grupos abiertos
                      $groups = $groups->where('applied',0);
                      break;
                  case 3:
                      //Mandar solo grupos cerrados
                      $groups = $groups->where('applied',1);
                      break;
                  case 4:
                      //Grupos con cupo disponible.
                      $groups = ToeflGroup::has('students','<',function($query){
                          $query->select('capacity');
                      });
                      break;
                  case 5:
                      //Grupos llenos.
                      $groups = ToeflGroup::has('students','>=',function($query){
                          $query->select('capacity');
                      });
                      break;
              }

          //Si hay una palabra clave de busqueda, buscar con ella
        if($keyword){
            $groups = $groups->search($keyword);
        }

           return view('toefl', [
              'groups' => $groups->paginate(12),
              'count' => $groups->count(),
              'total' => ToeflGroup::count(),
              'professors' => User::authorities()->get(),
              'classrooms' => Classroom::all(),
              'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
                
            ]);
    }

  public function showGroup(Request $request, $id){
          $group = ToeflGroup::where('id', $id)->first();
          $score = $group->getScores();
       
     
          return view('toefl-group', [
            'group' => $group,
            'score'=> $score,
            'professors' => User::authorities()->get(),
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
       $score = $group->getScores();

        return view('attendance-toefl-list', [
            'group' => $group,
            'score'=> $score,
            'students' => $students,
            'attendanceSlots' => 22,
        ]);
    }
 
  public function addStudent(Request $request){
        $group = ToeflGroup::find($request->input('groupId'));
        $student = Student::where('control_number',$request->input('studentId'))->first();
    
          if($group->applied == 0){
   
            //Revisar que el grupo tenga capacidad para un nuevo alumno
            if(count($group->students)>=$group->capacity){
                return redirect()->back()->with('message','El grupo ya se encuentra lleno.');
            }

            //Revisar si el alumno ya está en el grupo
           
            if($student->toefls->find($group->id) != null){
                return redirect()->back()->with('message', 'El alumno que usted intentó agregar ya estaba en el grupo.');
            }

            //Agregar el alumno al grupo
            $group->students()->attach($student);
            $group->save();
             // Registrar la acción en el historial
            History::create([
                'user_id' => Auth::user()->id,
                'description' => 'ha ingresado al alumno con No.Control :'.$request->input('studentId').' al grupo TOEFL ID: '.$request->input('groupId')
            ]);

            return redirect()->back()->with('success', $student->last_names.' '.$student->first_names.' fue agregado(a) con éxito al grupo.');
        } else {
           
           return redirect()->back()->with('message','El grupo TOEFL se encuentra cerrado.');
        }
    }

  public function removeStudent(Request $request){
      $group = ToeflGroup::find($request->input('groupId'));
      $student = Student::findOrFail($request->input('studentId'));      
      if($group->applied == 0){
               
            $group->students()->detach($student);
                     // Registrar la acción en el historial
            History::create([
                'user_id' => Auth::user()->id,
                'description' => 'ha eliminado al alumno ID:'.$student->control_number.' del grupo TOEFL ID: '.$request->input('groupId')
            ]);
            $group->save();
            return redirect()->back()->with('success', 'El alumno se eliminó del grupo con éxito.');
         }else{
             return redirect()->back()->with('message', 'El grupo TOEFL se encuentra cerrado.');
         }  
    }

  public function modify(Request $request){
       $group =  ToeflGroup::where('id',$request->input('idGroup'))->first();
  

        if($group->applied == 0){
          ToeflGroup::where('id',$request->input('idGroup'))
            ->update(['date' => $request->input('date'),
            'time' => $request->input('time'),
            'capacity' => $request->input('capacity'),
            'classroom_id' => $request->input('classroomId'),
            'responsable_user_id' => $request->input('responsableId'),
            'applicator_user_id' => $request->input('applicatorId'),
           
            ]);

            $group->save();
          // Registrar la acción en el historial
                History::create([
                    'user_id' => Auth::user()->id,
                    'description' => 'ha modificado el grupo TOEFL ID: '.$request->input('idGroup')
                ]);

                return redirect()->back()->with('success','El grupo TOEFL ha sido modificado con éxito');
        } else {
                return redirect()->back()->with('message','El grupo TOEFL se encuentra cerrado.');
        }
      
    }

  public function delete(Request $request){

        $group = ToeflGroup::findOrFail($request->input('idGroup'));
        $students = $group->students;
        if($group->applied == 1){

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

        return redirect('/toefl/')->with('success', 'El grupo ha sido eliminado con éxito.');
      } else {
        return redirect()->back()->with('message', 'El grupo TOEFL se encuentra abierto.');
      }
    }

  public function toggle(Request $request){
       $group = ToeflGroup::find($request->input('groupId'));
        $successMessage = '';

        if($group->applied == 1){
            $group->applied = 0;
            $successMessage = 'El grupo TOEFL se ha abierto con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha abierto el grupo TOEFL ID: '.$request->input('groupId')
        ]);
        } else {
            $group->applied = 1;
            $successMessage = 'El grupo TOEFL se ha cerrado con éxito.';
              // Registrar la acción en el historial
        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha cerrado el grupo TOEFL ID: '.$request->input('groupId')
        ]);
        }
        $group->save();

        return redirect()->back()->with('success', $successMessage);
}

public function updateScores(Request $request){
       
        $scores_table = $request->input('score');
        $groupId = $request->input('groupId');

        foreach ($scores_table as $key => $score_data) {
           

                        //Buscar un grade que cumpla
          $grade = StudentToeflGroup::where('student_id', $key)->where('toefl_group_id', $groupId)->first();

                        //Si no existe crearlo
                        if(is_null($grade)){
                            $grade = StudentToeflGroup::firstOrNew([
                                'student_id' => $key,
                                'toefl_group_id' => $groupId,
                                'score' => (!isset($scores_table[$key]) ? 0 : $scores_table[$key])
                            ]);
                            $grade->save();
                        }  //fin if

                        //Si ya existe, actualizarlo
                        else {
                            $grade->score = (!isset($scores_table[$key]) ? 0 : $scores_table[$key]);
                            $grade->save();
                       }
                } 
                 return redirect()->back()->with('success', 'Puntajes aplicados con éxito.');
    }


}
