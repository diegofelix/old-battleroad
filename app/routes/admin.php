<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'auth|organizer'], function()
{
    Route::get('register', [
        'as' => 'admin.register.index',
        'uses' => 'Registration\RegisterController@index'
    ]);

    Route::post('register', [
        'as' => 'admin.register.store',
        'uses' => 'Registration\RegisterController@store'
    ]);

    Route::group([
        // user cannot change a published championship and others championships
        'before' => 'championship_not_published|championship_owner'
    ], function()
    {
        /*
         |---------------------------------------------------------------------
         | Location Routes
         |---------------------------------------------------------------------
         |
         */

        // Route::get('register/{register}/location', [
        //     'as' => 'admin.register.location',
        //     'uses' => 'Registration\LocationController@create'
        // ]);

        // Route::post('register/{register}/location', [
        //     'as' => 'admin.register.storeLocation',
        //     'uses' => 'Registration\LocationController@store'
        // ]);

        /*
         |---------------------------------------------------------------------
         | Game Routes
         |---------------------------------------------------------------------
         |
         */

        Route::get('register/{register}/games', [
            'as' => 'admin.register.games',
            'uses' => 'Registration\CompetitionsController@index'
        ]);

        // Route::get('register/{register}/games/create', [
        //     'as' => 'admin.register.games.create',
        //     'uses' => 'Registration\CompetitionsController@create'
        // ]);

        Route::post('register/{register}/games/create', [
            'as' => 'admin.register.games.store',
            'uses' => 'Registration\CompetitionsController@store'
        ]);

        Route::delete('register/{register}/games/{games}', [
            'as' => 'admin.register.games.destroy',
            'uses' => 'Registration\CompetitionsController@destroy'
        ]);

        /*
         |---------------------------------------------------------------------
         | Princing Routes
         |---------------------------------------------------------------------
         */
        // Route::get('register/{register}/pricing', [
        //     'as' => 'admin.register.pricing',
        //     'uses' => 'Registration\PricingController@create'
        // ]);

        // Route::post('register/{register}/pricing', [
        //     'as' => 'admin.register.storePricing',
        //     'uses' => 'Registration\PricingController@store'
        // ]);

        /*
         |---------------------------------------------------------------------
         | Integration Routes
         |---------------------------------------------------------------------
         */
        Route::get('register/{register}/integration', [
            'as' => 'admin.register.integration',
            'uses' => 'Registration\IntegrationController@index'
        ]);

        Route::post('register/{register}/integration', [
            'as' => 'admin.register.integration',
            'uses' => 'Registration\IntegrationController@store'
        ]);

        // Route::get('register/{register}/login', [
        //     'as' => 'admin.register.login',
        //     'uses' => 'Registration\IntegrationController@login'
        // ]);

        /*
         |---------------------------------------------------------------------
         | Publish Routes
         |---------------------------------------------------------------------
         |
         */

        // confirm before publish
        Route::get('register/{register}/confirmation', [
            'as' => 'admin.register.confirmation',
            'uses' => 'Registration\PublisherController@confirmation'
        ]);

        // publish a championship
        Route::get('register/{register}/publish', [
            'as' => 'admin.register.publish',
            'uses' => 'Registration\PublisherController@publish'
        ]);
    });

    Route::get('championships', [
        'as' => 'admin.championships.index',
        'uses' => 'ChampionshipsController@index'
    ]);

    /*
     |---------------------------------------------------------------------
     | Manager Routes
     |---------------------------------------------------------------------
     |
     | In this section are the routes the handle the championship after
     | publication like, users joineds, games and etc.
     |
     */

    Route::group([
        'before' => 'championship_published|championship_owner',
    ], function()
    {
        Route::get('championships/{id}', [
            'as' => 'admin.championships.show',
            'uses' => 'ChampionshipsController@show'
        ]);

        Route::get('championships/{id}/edit', [
            'as' => 'admin.championships.edit',
            'uses' => 'ChampionshipsController@edit'
        ]);

        Route::post('championships/{id}/edit', [
            'as' => 'admin.championships.update',
            'uses' => 'ChampionshipsController@update'
        ]);

        // banner
        Route::get('championships/{id}/banner', [
            'as' => 'admin.championships.banner',
            'uses' => 'ChampionshipsController@banner'
        ]);

        Route::get('championships/{id}/banner-edit', [
            'as' => 'admin.championships.banner_edit',
            'uses' => 'ChampionshipsController@editBanner'
        ]);

        Route::post('championships/{id}/banner-edit', [
            'as' => 'admin.championships.banner_update',
            'uses' => 'ChampionshipsController@updateBanner'
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

        Route::get('championships/{id}/cancel', [
            'as' => 'admin.championships.cancel',
            'uses' => 'ChampionshipsController@cancel'
        ]);

        Route::get('championships/{id}/coupons', [
            'as' => 'admin.championships.coupons',
            'uses' => 'CouponsController@index'
        ]);

        Route::post('championships/{id}/coupons', [
            'as' => 'admin.championships.coupons.generate',
            'uses' => 'CouponsController@generate'
        ]);
    });

    Route::get('dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'DashboardController@index'
    ]);
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'before' => 'auth'], function()
{
    Route::get('joins', [
        'as' => 'admin.joins',
        'uses' => 'JoinsController@index'
    ]);
});