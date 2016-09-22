<?php namespace App\Library;


class Common {
	
	public function __construct() {
		// place your constructor here
	}
	
	/**
	 * checked onair status of the teacher if its available,
	 * otherwise returned with "default" text
	 * @param  Object $onair  onair's data
	 * @return String         teacher status complete word
	 */
	public static function getTeacherStatus($onair) {
		
		// Teacher status options
		$optStatus = array(
			"1" => "standby",
			"2" => "reserved",
			"3" => "lesson"
		);
		
		return isset($onair) && isset($optStatus[$onair->status]) ? $optStatus[$onair->status] : "default";
	}
}