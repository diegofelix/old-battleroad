<?php

Route::controller('password', 'RemindersController');

// Common auth
Route::get('login', ['as' => 'session.create', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'session.destroy', 'uses' => 'SessionController@destroy']);
Route::post('login', ['as' => 'session.store', 'uses' => 'SessionController@store']);

// Social Auth
Route::get('google', ['as' => 'auth.google', 'uses' => 'AuthController@google']);
Route::get('facebook', ['as' => 'auth.facebook', 'uses' => 'AuthController@facebook']);

// Profile Resource
Route::resource('profile', 'ProfileController', ['except' => ['index', 'destroy']]);
