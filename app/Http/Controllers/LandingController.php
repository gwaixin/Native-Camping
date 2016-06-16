<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class LandingController extends Controller {
    
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
