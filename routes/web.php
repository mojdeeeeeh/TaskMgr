<?php

use Illuminate\Http\Request;

Route::view('test', 'test');
Route::post('test/postData', function(Request $request){
	dd($request->is('/test/postData'));
	
	$sender = \App\User::find($request->sender_id);
	return [$request, $sender];

	$username = $request->username;

	return "Your name is " . $username;
});

Auth::routes();

Route::redirect('/', '/home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController');
Route::get('/t-users', 'UsersController@tIndex');

Route::resource('/tasks', 'TaskController');

Route::resource('/statuses', 'TaskStatusController');


