<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Onair extends Model {
	
	protected $table = 'onairs';
	
	protected $fillable = array(
		'teacher_id',              // Teacher's id
		'student_id',              // Student's id
		'status',                  // Status for lesson => 1: standby, 2: reserved, 3: lesson
		'connect_flg',             // Connection flag => 1: connected, 0: not connected
		'chat_hash',               // Chat hash for this lesson
		'wait_start_time',         // Datetime start registered during standby
		'wait_end_time',           // Datetime end during end of standby
		'start_time',              // Datetime of start in lesson
		'end_time',                // Datetime end of lesson
		'lesson_type',             // Lesson type => 1: normal, 2:reserved
		'web_rtc_type',            // webrtc type => 1: skyway, 2:other
		'lesson_finish'            // lesson finish boolean => 1: finish, 0: not finish
	);
	
	public function save(array $options = []) {
		
		/* before saving, check if chat_hash is still empty */
		if (empty($this->chat_hash)) {
			/* create new chat hash */
			$this->chat_hash = $this->teacher_id . '-' . time() . '-' . substr((md5(uniqid(rand(),1))), 0, 6);
		}
		
		// return to proceed parent save
		return parent::save();
	}
	
}
