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

Route::get('how-it-works', [
    'as' => 'how_it_works',
    'uses' => 'PagesController@howItWorks'
]);

Route::get('how-it-works/organizer', [
    'as' => 'how_organizer',
    'uses' => 'PagesController@organizer'
]);

Route::get('how-it-works/player', [
    'as' => 'how_player',
    'uses' => 'PagesController@player'
]);

Route::get('changelog', [
    'as' => 'changelog',
    'uses' => 'PagesController@changelog'
]);