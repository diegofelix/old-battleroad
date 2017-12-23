<?php

Route::get('championships', ['as' => 'championships.index', 'uses' => 'ChampionshipsController@index']);
Route::get('championships/{championship}', ['as' => 'championships.show', 'uses' => 'ChampionshipsController@show']);
