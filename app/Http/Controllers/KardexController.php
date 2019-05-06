<?php

namespace App\Http\Controllers;
 

use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\ToeflGroup;
use App\StudentToeflGroup;
use App\User;
use App\Career;
use App\Period;
use App\Grade;
use App\Setting;
use App\Point;
use App\Group;
use Illuminate\Http\Request;

class KardexController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'kardex';

       public function showMyKardex(Request $request){
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
       if(!Auth::user()->hasAnyRole(['student'])){ //es solo para alumnos por pero por pruebas se deja para admin tambien
            return view('auth.nopermission');
        }

      
        $student=Student::where('user_id',Auth::user()->id)->first();
        $now=date('d-m-Y');
        $careers = Career::all();

        $groupstoefl = StudentToeflGroup::where('student_id',$student->id)->get();
      
        $matricula=$student->control_number;
        $dig=substr($matricula, 0, -6);
        $year='20'.$dig;
        $requiredcredits = Point::where('year',$year)->first();

       // $group = $student->groups->first();

        $partialCount = (int)Setting::where('name', 'partial_count')->first()->value;
        $averagesStructure = array();   
        $groups= $student->groups;

    foreach ($groups as $group) {

                 foreach (Student::all() as $student) {
                    $average = 0;
                    $studentGrades = Grade::where('group_id', $group->id)->where('student_id', $student->id)->get();
                    foreach ($studentGrades as $grade) {
                        $average = $average + $grade->score;
                    }
                    $averagesStructure[$student->id] = $average / $partialCount;
                }

        $averages= $averagesStructure;
    }

     

      
//dd($averages);

        return view('kardex', [
            'groupstoefl' => $groupstoefl,
           // 'groupnormal' => $groupnormal,
            'averages' => $averages,
            'student' => $student,
            'requiredcredits' => $requiredcredits,
            'date' => $now,
            'career' => $careers,
            'parentRoute' => KardexController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    

}
