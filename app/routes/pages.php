<?php

// Home Page
Route::get('/', 'HomeController@index');

// Profile Resource
Route::resource('profile', 'ProfileController', ['except' => ['index', 'destroy']]);

// Championships
Route::resource('championships', 'ChampionshipsController', ['only' => ['index', 'show']]);