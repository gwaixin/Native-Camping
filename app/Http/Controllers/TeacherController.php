<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use \Auth;

class TeacherController extends Controller
{
  
    public function __construct() {
      $this->middleware('auth');
      $this->middleware('role:teacher');
    }
    public function index() {
      return view('teachers.index', ['title' => 'Welcome Teacher']);
    }
    
    public function lesson(Request $request) {
			return view('teachers.lesson', [
				'title'     => 'Lesson On', 
				'teacherID' => Auth::user()->id,
				'ipAdress'  => $request->ip(),
				'scripts'   => [
					'webrtc/socket.io',
					'webrtc/peer.min',
					'webrtc/constant', 
					'webrtc/connect',
					'webrtc/event.common',
					'webrtc/event.teacher'
				]
			]);
    }
    
    public function textbook() {
      return view('teachers.textbook', ['title' => 'Textbook']);
    }
}
