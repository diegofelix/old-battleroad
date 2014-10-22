<?php

// Home Page
Route::get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index'
]);

// Tutorial Bcash
Route::get('tutorial-bcash', [
    'as' => 'tutorial_bcash',
    'uses' => 'HomeController@bcash'
]);