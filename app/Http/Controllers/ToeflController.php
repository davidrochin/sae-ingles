<?php

namespace App\Http\Controllers;
 
use App\Student;
use App\Career;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;

class ToeflController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'toefl';


       public function showAll(Request $request){
       
        return view('toefl', [
          
            'parentRoute' => StudentsController::DEFAULT_PARENT_ROUTE,
        ]);
    }

//se tiene que validar que se muestre si se cumplio con el requisito de puntos
    public function accreditationTOEFL(){

 
        return view('accreditation-toefl'); 
    }


}
