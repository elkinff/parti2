<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller{

    public function index(){
    	// dd(Auth::user());
        return view('pages.dashboard.muro');

    }
}
