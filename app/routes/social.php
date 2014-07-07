<?php

// Authentication from social networks
Route::get('google', ['as' => 'auth.google', 'uses' => 'AuthController@google']);
Route::get('facebook', ['as' => 'auth.facebook', 'uses' => 'AuthController@facebook']);