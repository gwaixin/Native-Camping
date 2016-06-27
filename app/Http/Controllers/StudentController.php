<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class StudentController extends Controller
{
  
    public function __construct() {
      $this->middleware('auth');
    }
    public function index() {
      return view('students.index', ['title' => 'Welcome Student']);
    }
    
    public function teachers() {
      return view('students.teachers', ['title' => 'Teacher List']);
    }
}
