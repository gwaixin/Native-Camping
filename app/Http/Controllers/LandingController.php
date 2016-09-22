<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use \Auth;

class LandingController extends Controller {
    
		public function __construct() {
			$this->middleware('role:none');
		}
		
    public function index() {
    	return view('landing.index', ['title' => 'home']);
    }

    public function register() {
    	return view('landing.register', ['title' => 'register']);
    }

    public function about() {
    	return view('landing.about', ['title' => 'about']);
    }

    public function contact() {
    	return view('landing.contact', ['title' => 'contact']);
    }
}
