<?php

namespace App\Http\Controllers;
 
use App\Student;
use App\Career;
use App\ToeflGroup;
use App\User;
use App\Util;
use function foo\func;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateStudentRequest;
use App\Http\Requests\DeleteStudentRequest;
use App\Http\Requests\ModifyStudentRequest;
use Illuminate\Http\Request;

class ToeflGroupController extends Controller
{

    const DEFAULT_PARENT_ROUTE = 'toefl';


//se tiene que validar que se muestre si se cumplio con el requisito de puntos
    public function accreditationTOEFL(){
setlocale(LC_ALL,"es_ES");
date_default_timezone_set('America/Mazatlan');
$numero=date('Y');
$texto=Util::convertir($numero);
$year = ucfirst($texto);
  
$fecha= strftime("%d días del mes de %B del año ".$year);


        return view('accreditation-toefl', [
          'fecha' => $fecha,
            'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
           
        ]);
    }


    public function showAll(Request $request){

     
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission', [
                'permissionMessage' => 'Para consultar grupos usted necesita ser administrador o coordinador.',
            ]);
        }

        //$groups = Group::orderBy('active', 'DESC');
        $groups = ToeflGroup::orderBy('id', 'DESC');




         return view('toefl', [
          'groups' => $groups->paginate(12),
            'parentRoute' => ToeflGroupController::DEFAULT_PARENT_ROUTE,
            'professors' => User::professors()->get(),
        ]);
    }



}
