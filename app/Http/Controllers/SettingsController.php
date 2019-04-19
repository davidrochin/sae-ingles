<?php

namespace App\Http\Controllers;
 

use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Career;
use App\Setting;
use App\History;
use App\User;
use App\Points;
use App\Classroom;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCareerRequest;

class SettingsController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'settings';


       public function showSettings(Request $request){
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin'])){
            return view('auth.nopermission');
        }

       
        return view('settings', [
            'careers' => Career::all(),
            'classrooms'=> Classroom::all(),
            'grades' =>  Setting::findOrFail(1),
            'parentRoute' => SettingsController::DEFAULT_PARENT_ROUTE,
        ]);
    }

       public function createCareer(CreateCareerRequest $request){
       $career=  Career::create([
          
            'name' => $request->input('name'),
            'short_name' =>  $request->input('short_name'),
        ]);
       
       return redirect()->back()->with('success', 'La carrera ha sido creada con éxito.');
    }

      public function createClassroom(Request $request){
      $classroom=  Classroom::create([
          
            'name' => $request->input('name'),
           
        ]);
       
       return redirect()->back()->with('success', 'El aula ha sido creada con éxito.');
    }

     public function rangesSetting(Request $request){
          
            Setting::where('id',1)
            ->update(['value' => $request->input('parciales')]);

        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha cambiado la cantidad de parciales a '.$request->input('parciales')
        ]);  
                  
            $year=$request->input('year');
            $points=$request->input('points');
            $credits= Points::where('year', $year);

           
                
               //crea generacion
                if(($credits)!=($year)){
                    $credits = Points::create([
                        'year' => $year,
                        'points' => $points
                        
                    ]);
                  
                } 

                //actualiza generacion
                else {
                    Points::where('year',$request->input('year'))->update(['year' => $year, 'points'=>$points]);
                   
                }
                   


        History::create([
            'user_id' => Auth::user()->id,
            'description' => 'ha registrado que el año '.$request->input('year').' requiere '.$request->input('points').' puntos TOEFL.'
        ]);
       
       return redirect()->back()->with('success', 'Se guardaron los cambios exitosamente.');
    }




}
