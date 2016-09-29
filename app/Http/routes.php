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
Route::get('/student/teacher/list', 'StudentController@teachers');
Route::get('/student/teacher/{id}', 'StudentController@teacherDetail');
Route::get('/student/lesson_finish', 'StudentController@lessonFinish');
Route::post('/student/lesson', 'StudentController@lesson');

# Teacher
Route::get('/teacher', 'TeacherController@index');
Route::get('/teacher/lesson', 'TeacherController@lesson');
Route::get('/teacher/textbook', 'TeacherController@textbook');

# API Users
Route::get('/user/teacher/all', 'UserController@teachers');
Route::get('/user/teacher/{id}', 'UserController@teacher');
Route::put('/user/teacher/{id}', 'UserController@teacherUpdate');
Route::delete('/user/teacher/{id}', 'UserController@teachereDelete');

Route::get('/user/student/all', 'UserController@students');
Route::get('/user/student/{id}', 'UserController@student');
Route::put('/user/student/{id}', 'UserController@studentUpdate');
Route::delete('/user/student/{id}', 'UserController@studentDelete');
