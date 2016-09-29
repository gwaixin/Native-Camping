<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Library\Common;

use App\User;
use App\Onair;

use Validator;
use Redirect;
use Auth;

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
      return view('students.teachers', [
				'title' => 'Teacher List',
				'scripts' => [
					'angular/controller/student/teacher-list'
				]
			]);
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
				'status'  => $onAirStatus,
				'onair'   => $onair
			]);
		}
		
		public function lesson(Request $request) {
			$onair = NULL;
			/* validate the request data */
			$validator = Validator::make($request->all(), [
				'chat_hash'   => 'required',
				'teacher_id' => 'required'
			]);
			
			/* now checked validation if pass or not */
			if ($validator->fails()) {
				/* redirect back to detail with error */
				return Redirect::back()->withErrors($validator);
			} else {
				/* find onairs by chathash */
				$onair = Onair::where(['chat_hash' => $request->chat_hash])->first();
			}
			
			/* check if onair exist */
			if (empty($onair)) {
				/* redirect back to detail, chathash not found */
				return Redirect::back()->with(['customError' => "ChatHash does not exist"]);
			} else {
				/* update onair lesson */
				$onair->student_id = Auth::user()->id;
				$onair->wait_end_time = date('Y-m-d H:i:s');
				$onair->lesson_type = 1; // type
				$onair->status = 3; // lesson
				
				/* saving onair lesson */
				if ($onair->save()) {
					/* proceed to view student lesson start */
					return view('students.lesson', [
						'title'    => "LESSON - STUDENT",
						'onair'    => $onair,
						'user'     => Auth::user(),
						'ipAdress' => $request->ip(),
						'ngController' => 'Lesson',
						'scripts'  => [
							'webrtc/socket.io',
							'webrtc/peer.min',
							'webrtc/constant',
							'webrtc/connect',
							'webrtc/event.common',
							'webrtc/event.student',
							'angular/controller/student/lesson'
						]
					]);
				} else {
					/* redirect back to detail, there has been during updating onair */
					return Redirect::back()->with(['customError' => "Internal Server Error on updating onair during start lesson"]);
				}
			}
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
