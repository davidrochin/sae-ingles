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
        
       // dd($requiredcredits->points);
      //  $group = Group::where('id', $id)->first(); //$id falta obtener los id de los grupos que esta el alumno
        //$averages = $group->getAverages();

        return view('kardex', [
            'groupstoefl' => $groupstoefl,
            'student' => $student,
            'requiredcredits' => $requiredcredits,
       //     'averages' => $averages,
            'date' => $now,
            'career' => $careers,
            'parentRoute' => KardexController::DEFAULT_PARENT_ROUTE,
        ]);
    }

    

}
