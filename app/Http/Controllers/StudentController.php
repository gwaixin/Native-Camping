<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Library\Common;

use App\User;
use App\Onair;

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
			/* Fetch teacher's information */
			$teacher = User::find($id);

			/* Redirects to teacher list if teacher does not exist */
			if (empty($teacher)) {
				return redirect()
					->action("StudentController@teachers")
					->with(['message' => "Teacher id does not match any record, redirected to teacher's list."]);
			}

			/* Fetch teacher's current lesson if it has any */
			$onair = Onair::where(['teacher_id' => $id])->first();

			/* Prepare lesson onair teacher status */
			$onAirStatus = Common::getTeacherStatus($onair);

			return view('students.teacherDetail', [
				/* data that will pass to view */
				'title'   => 'Teacher Detail',
				'teacher' => $teacher,
				'status'  => $onAirStatus
			]);
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
