<?php

// Home Page
Route::get('/', 'HomeController@index');

// Profile Resource
Route::resource('profile', 'ProfileController', ['except' => ['index', 'destroy']]);

// Championships
Route::resource('championships', 'ChampionshipsController', ['only' => ['index', 'show']]);
Route::get('championships/{id}/register', [
    'as' => 'championships.register',
    'uses' => 'ChampionshipsController@register'
]);
Route::post('championships/payment', [
    'as' => 'championships.payment',
    'uses' => 'ChampionshipsController@payment'
]);