<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

class StudentController extends Controller
{
  
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('role:student');
    }
    public function index() {
      return view('students.index', ['title' => 'Welcome Student']);
    }
    
    public function teachers() {
      return view('students.teachers', ['title' => 'Teacher List']);
    }
    
    public function teacherDetail($id) {
      $teacher = User::find($id);
      return view('students.teacherDetail', ['title' => 'Teacher Detail', 'teacher' => $teacher]);
    }
    
    public function startLesson() {
      //TODO
    }
    
    public function endLesson() {
      //TODO
    }
    
    public function textbook() {
      //TODO
    }
    
}
