<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {
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
