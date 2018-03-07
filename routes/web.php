<?php

Auth::routes();

Route::redirect('/', '/home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController');
Route::get('/t-users', 'UsersController@tIndex');
