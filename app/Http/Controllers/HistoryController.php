<?php

namespace App\Http\Controllers;
 
use function foo\func;
use App\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller {

    const DEFAULT_PARENT_ROUTE = 'history';

    public function showAll(Request $request) {
        //Si el usuario no tiene estos permisos, regresar una vista que le dice que no tiene los permisos necesarios.
        if(!Auth::user()->hasAnyRole(['admin', 'coordinator'])){
            return view('auth.nopermission');
        }
        return view('history', [
            'history' => History::orderBy('created_at', 'DESC')->paginate(12),
            'parentRoute' => HistoryController::DEFAULT_PARENT_ROUTE,
        ]);
    }
}
