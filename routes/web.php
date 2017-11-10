<?php


Route::get('/', function () {
    return view('user.index');
})->name('user.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin'],function(){
	Route::get('admin/home','IndexController@home')->name('admin.index');
	
	Route::resource('admin/admins','AdminController');
	Route::resource('admin/categories','CategoryController');
	Route::resource('admin/polls','PollsController');
	Route::resource('admin/questions','QuestionController');
	Route::resource('admin/answers','AnswerController');
	Route::resource('admin/ranges','RangeController');

	// Admin Auth Routes
	Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login.post');
	Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
	
});

Route::group(['namespace' => 'User'],function(){
	Route::resource('user/encuestas','EncuestasController');
	
});