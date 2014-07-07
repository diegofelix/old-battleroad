<?php

// Handle the authentication
Route::get('login', ['as' => 'session.create', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'session.destroy', 'uses' => 'SessionController@destroy']);
Route::post('login', ['as' => 'session.store', 'uses' => 'SessionController@store']);