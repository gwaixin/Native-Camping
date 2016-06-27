<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

# landings
Route::get('/', 'LandingController@index');
Route::get('/register', 'LandingController@register');
Route::get('/about', 'LandingController@about');
Route::get('/contact', 'LandingController@contact');

# Auths
Route::get('/login', 'LandingController@index');
Route::post('/login', 'AuthController@login');
Route::get('/logout', 'AuthController@logout');
Route::post('/register', 'AuthController@register');

# Student
Route::get('/student', 'StudentController@index');
Route::get('/student/teachers', 'StudentController@teachers');