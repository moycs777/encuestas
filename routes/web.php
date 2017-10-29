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

Route::get('/', function () {
    return view('welcome');
});



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','IndexController@home')->name('admin.index');
	
	Route::resource('admin/admins','AdminController');
	Route::resource('admin/polls','PollsController');
	Route::resource('admin/categories','CategoryController');
	Route::resource('admin/ranges','RangeController');
	Route::resource('admin/questions','QuestionController');
	Route::get('admin/questions/showquestions/{id}', 'QuestionController@showquestions');
	Route::post('admin/questions/createquestion', 'QuestionController@createquestion')->name('pregunta.anadir');
	Route::post('admin/questions/deletequestion', 'QuestionController@deletequestion')->name('pregunta.eliminar');
	Route::post('admin/questions/updatequestion', 'QuestionController@updatequestion')->name('pregunta.actualizar');
	// Answer
	Route::post('admin/questions/createanswer', 'QuestionController@createanswer')->name('respuesta.anadir');
	Route::post('admin/questions/deleteanswer', 'QuestionController@deleteanswer')->name('respuesta.eliminar');
	Route::post('admin/questions/updateanswer', 'QuestionController@updateanswer')->name('respuesta.actualizar');
	// Admin Auth Routes
	Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login.post');
	Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
	
	// Stores controller
});

Route::group(['namespace' => 'User'],function(){
	Route::resource('user/encuestas','EncuestasController');
	
	
	
	// Stores controller
});