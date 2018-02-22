<?php

namespace App\Http\Controllers;

use App\Student;
use App\Http\Requests\CreateStudentRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function show(){

    	//$students = Student::all();
    	$students = Student::paginate(13);

    	return view('students', [
    		'students' => $students
    	]);
    }

    public function create(CreateStudentRequest $request){

    	//Vardump de los datos del request
    	//dd($request->all());

    	//$this->validate($request);

    	$student = Student::create([
    		'control_number' => $request->input('controlNumber'),
    		'career' => $request->input('career'),
    		'first_names' => $request->input('firstNames'),
    		'fathers_last_name' => $request->input('fathersLastName'),
    		'mothers_last_name' => $request->input('mothersLastName'),
    		'phone_number' => $request->input('phoneNumber'),
    		'email' => $request->input('email')
    	]);

    	//dd($student);

    	//return redirect('/alumnos/'.$messages->id);
    	return redirect('/alumnos/');
    }
}
