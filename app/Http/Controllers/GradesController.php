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

    	//dd($request);
    	//dd(Grade::where('student_id', 257)->where('group_id', 10)->first());

    	$studentIds = $request->input('studentIds');
    	$scores = $request->input('scores');
    	$partials = $request->input('partials');
    	$groupId = $request->input('groupId');

    	$partialCount = Setting::where('name', 'partial_count')->first()->value;

    	for ($i=0; $i < sizeof($scores); $i++) { 
    		$grade = Grade::where('student_id', $studentIds[$i])->where('group_id', $groupId)->where('partial', $partials[$i])->first();

    		//Si no existe crearlo
    		if(is_null($grade)){
    			$grade = Grade::firstOrNew([
	    			'student_id' => $studentIds[$i],
	    			'group_id' => $groupId,
	    			'partial' => $partials[$i],
	    			'score' => (is_null($scores[$i]) ? 0 : $scores[$i])
	    		]);
	    		$grade->save();
    		} 

    		//Si ya existe, actualizarlo
    		else {
    			$grade->score = (is_null($scores[$i]) ? 0 : $scores[$i]);
    			$grade->save();
    		}
    	}
    	return redirect()->back()->with('success', 'Calificaciones aplicadas con éxito.');
    }
}
