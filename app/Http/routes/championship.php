<?php

// Championships
Route::resource('championships', 'ChampionshipsController', ['only' => ['index', 'show']]);
Route::get('championships/{championships}/embeded', ['as' => 'championships.embeded', 'uses' => 'EmbededJoinController@index']);
Route::post('championships/{championships}/embeded', ['as' => 'championships.embeded', 'uses' => 'EmbededJoinController@store']);
