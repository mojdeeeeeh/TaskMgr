<?php

Auth::routes();

Route::redirect('/', '/home');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/users', 'UsersController');
