<?php

namespace App\Http\Controllers;
 

use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Career;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'settings';


       public function showSettings(Request $request){

       
        return view('settings', [
            'careers' => Career::all(),
            'parentRoute' => SettingsController::DEFAULT_PARENT_ROUTE,
        ]);
    }


}
