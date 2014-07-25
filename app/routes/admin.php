<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'auth|has_moip'], function(){

    // championship resource
    Route::resource('championships', 'ChampionshipsController');

    Route::get('register', [
        'as' => 'admin.register.index',
        'uses' => 'RegisterController@index'
    ]);

    Route::post('register', [
        'as' => 'admin.register.store',
        'uses' => 'RegisterController@store'
    ]);

    Route::group(['before' => 'championship_not_published'], function()
    {
        // location
        Route::get('register/{id}/location', [
            'before' => 'championship_not_published',
            'as' => 'admin.register.location',
            'uses' => 'RegisterController@location'
        ]);

        // save location
        Route::post('register/{id}/location', [
            'before' => 'championship_not_published',
            'as' => 'admin.register.storeLocation',
            'uses' => 'RegisterController@storeLocation'
        ]);

        // nested resource games.
        Route::resource('register.games', 'CompetitionsController');

        // confirmation
        Route::get('register/{id}/confirmation', [
            'as' => 'admin.register.confirmation',
            'uses' => 'RegisterController@confirmation'
        ]);

        // publish a championship
        Route::get('register/{id}/publish', [
            'as' => 'admin.register.publish',
            'uses' => 'RegisterController@publish'
        ]);
    });

    /*// location
    Route::get('championships/{id}/location', [
            'as' => 'admin.championships.location',
            'uses' => 'ChampionshipsController@location'
    ]);

    // save location
    Route::post('championships/{id}/location', [
        'as' => 'admin.championships.storeLocation',
        'uses' => 'ChampionshipsController@storeLocation'
    ]);

    // publish a championship
    Route::get('championships/{id}/publish', [
        'as' => 'admin.championships.publish',
        'uses' => 'ChampionshipsController@publish'
    ]);*/

    // banner
    Route::get('championships/{id}/banner', [
        'as' => 'admin.championships.banner',
        'uses' => 'ChampionshipsController@banner'
    ]);

    // games
    Route::get('championships/{id}/games', [
        'as' => 'admin.championships.games',
        'uses' => 'CompetitionsController@index'
    ]);

    Route::get('championships/{id}/games/{gameId}', [
        'as' => 'admin.championships.games.show',
        'uses' => 'CompetitionsController@show'
    ]);

    // users in the championship
    Route::get('championships/{id}/users', [
        'as' => 'admin.championships.users',
        'uses' => 'ChampionshipsController@users'
    ]);
    // feedback from users
    Route::get('championships/{id}/feedback', [
        'as' => 'admin.championships.feedback',
        'uses' => 'ChampionshipsController@feedback'
    ]);
});