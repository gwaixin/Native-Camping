<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    protected $fillable = array(
    	'email',
			'password',
			'fname',
			'mname',
			'lname',
			'address',
			'country',
			'user_type',
			'status'
    );

    protected $attributes = array(
    	'status' => 1
    );
    
    public function hasRole($role) {
      $hasRole = false;
      switch($role) {
        case 'student':
          if ($this->user_type == 1) $hasRole = true;
          break;
        case 'teacher': 
          if ($this->user_type == 2) $hasRole = true;
          break;
      }
      return $hasRole;
    }
    
}
