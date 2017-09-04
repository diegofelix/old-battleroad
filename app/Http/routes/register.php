<?php

// register
Route::get('register', ['as' => 'register.index', 'uses' => 'RegisterController@index']);
Route::post('register', ['as' => 'register.store', 'uses' => 'RegisterController@store']);