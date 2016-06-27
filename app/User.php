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
}
