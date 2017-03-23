<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home Route
Route::get('/',[
	'as'=>'home',
	'uses'=>'PagesController@getHomePage'
	]);


//Coursestaken Index page route:
Route::get('coursestaken/{id}',[
	'as'=>'coursestaken.index',
	'uses'=>'CourseTakenController@index']);

Route::delete('coursestaken/{id}',[
	'as'=>'course.delete',
	'uses'=>'CourseTakenController@delete']);





//All SubjectsController Route
Route::resource('allcourses','AllCoursesController');


//Timetable Route:
Route::get('timetable',[
	'as'=>'timetable',
	'uses'=>'CourseTakenController@getTimetable']);