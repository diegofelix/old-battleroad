<?php

// Championships
Route::resource('championships', 'ChampionshipsController', ['only' => ['index', 'show']]);

Route::get('payment/{id}', ['as' => 'payment', 'uses' => 'ChampionshipsController@payment']);
Route::post('moip', 'ChampionshipsController@moipReturn');