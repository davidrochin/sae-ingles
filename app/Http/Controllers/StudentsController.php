<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    //
    public function show(){
    	$students = Student::all();
    	return view('students', [
    		'students' => $students
    	]);
    }
}
