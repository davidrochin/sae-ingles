<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    //

    /*public function students(){
    	if(Auth::check()){
    		return view('/students');
    	} else {
    		return redirect('/login');
    	}
    }*/

    public function home(){
    	return view('home');
    }

    public function about(){
        return view('about');
    }
}
