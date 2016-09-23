<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Onair;

use \Auth;
use Validator;

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
			
			/* initiate variables */
			$res = array('result' => false, 'method' => '');
			
			/* get teacher's current lesson onairs */
			$onair = Onair::where('teacher_id', Auth::user()->id)->first();
			
			/* checks teacher has lesson onairs */
			if ($onair) {
				/* update wait_start_time */
				$onair->wait_start_time = date("Y-m-d H:i:s");
				
				/* set method for tracking errors */
				$res['method'] = 'update_onair';
				
				$res['result'] = true;
			/* onair does not exist, so create one */
			} else {
				/* prepare data for creating new lesson onairs */
				$onair = new Onair;
				$onair->teacher_id = Auth::user()->id;
				$onair->status = 1;
				$onair->connect_flg = 0;
				$onair->wait_start_time = date('Y-m-d H:i:s');
				
				/* set method for tracking errors */
				$res['method'] = 'create_onair';
				
				$res['result'] = true;
			}
			
			/* save lesson onairs */
			if ($onair->save() && $res['result']) {
				/* return view with data needed for the page */
				return view('teachers.lesson', [
					'title'     => 'Lesson On', 
					'teacherID' => Auth::user()->id,
					'ipAdress'  => $request->ip(),
					'chatHash'  => $onair->chat_hash,
					'scripts'   => [
						/* sets external scripts for this page */
						'webrtc/socket.io',
						'webrtc/peer.min',
						'webrtc/constant', 
						'webrtc/connect',
						'webrtc/event.common',
						'webrtc/event.teacher'
					]
				]);
			/* fail to create lesson onair */	
			} else {
				echo "Error [500] : Interval server error, fail in method " . $res['method'];
			}
    }
    
    public function textbook() {
      return view('teachers.textbook', ['title' => 'Textbook']);
    }
}
