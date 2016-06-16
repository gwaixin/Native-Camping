<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Hash;

use Validator;
use Redirect;

class AuthController extends Controller
{
    public function login(Request $request) {
    	$validator = Validator::make($request->all(), [
    		'email' => 'required|email',
    		'password' => 'required'
    	]);
    	if ($validator->fails()) {
    		return Redirect::back()->withErrors($validator)->withInput();
    	} else {
    		$errorMessage = "";
    		// search for user by email
    		$user = User::where('email', $request->email)->first();
    		if ($user) {
    			// checks password if match
    			if (Hash::check($request->password, $user->password)) {
    				return redirect()->action('StudentController@index');
    			} else {
    				$errorMessage = "Email and password does not match";
    			}
    		} else {
    			$errorMessage = "Email does not exist";
    		}
    		return redirect()->back()->with(['customError' => $errorMessage])->withInput();
    	}
    }

    public function logout() {

    }

    public function register(Request $request) {
    	$validator = Validator::make($request->all(), [
	    	'firstname'        => 'required',
				'lastname'         => 'required',
				'email'            => 'required|unique:users,email|email',
				'password'         => 'required|min:6',
				'confirm_password' => 'required|min:6|same:password',
				'type'             => 'required',
	    ]);

	    if ($validator->fails()) {
	    	return Redirect::back()->withErrors($validator)->withInput();
	    } else {
	    	$user = new User;
	    	$user->fname = $request->firstname;
				$user->lname = $request->lastname;
				$user->email = $request->email;
				$user->password = Hash::make($request->password);
				$user->user_type = $request->type == 'student' ? 1 : 2;
				$data = array();
				if ($user->save()) {
					$data['action'] = 'LandingController@index';
					$data['message'] = 'You have successfully register, you may now login';
				} else {
					$data['action'] = 'LandingController@register';
					$data['message'] = 'Internal Server error';
				}
				return redirect()->action($data['action'])->with(['message' => $data['message']]);
	    }

    }
}
