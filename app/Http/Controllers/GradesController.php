<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradesController extends Controller
{
    public function showOwnedGroups(Request $request){
    	return view('auth.nopermission', [
    		'permissionMessage' => 'Esta página está pendiente.',
    	]);
    } 
}
