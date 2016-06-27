<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class TeacherController extends Controller
{
  
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('role:teacher');
    }
    public function index() {
      return view('teachers.index', ['title' => 'Welcome Teacher']);
    }
    
    public function lesson() {
      return view('teachers.lesson', ['title' => 'Lesson On']);
    }
    
    public function textbook() {
      return view('teachers.textbook', ['title' => 'Textbook']);
    }
}
