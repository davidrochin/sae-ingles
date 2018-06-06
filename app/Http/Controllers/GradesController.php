<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateGradesRequest;

use App\Student;
use App\Group;
use App\Grade;
use App\Setting;

class GradesController extends Controller
{
    public function showOwnedGroups(Request $request){
    	return view('auth.nopermission', [
    		'permissionMessage' => 'Esta página está pendiente.',
    	]);
    }

    public function updateGrades(UpdateGradesRequest $request){

        $grades_table = $request->input('grades');
    	$groupId = $request->input('groupId');

    	$partial_count = Setting::where('name', 'partial_count')->first()->value;

        foreach ($grades_table as $key => $grade_data) {
            for ($i=1; $i <= $partial_count; $i++) { 

                //Buscar un grade que cumpla
                $grade = Grade::where('student_id', $key)->where('group_id', $groupId)->where('partial', $i)->first();

                //Si no existe crearlo
                if(is_null($grade)){
                    $grade = Grade::firstOrNew([
                        'student_id' => $key,
                        'group_id' => $groupId,
                        'partial' => $i,
                        'score' => (!isset($grades_table[$key][$i]) ? 0 : $grades_table[$key][$i])
                    ]);
                    $grade->save();
                } 

                //Si ya existe, actualizarlo
                else {
                    $grade->score = (!isset($grades_table[$key][$i]) ? 0 : $grades_table[$key][$i]);
                    $grade->save();
                }
            }
        }

    	return redirect()->back()->with('success', 'Calificaciones aplicadas con éxito.');
    }
}
