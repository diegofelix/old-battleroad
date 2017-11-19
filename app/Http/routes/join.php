<?php

Route::group(['middleware' => 'auth'], function () {
    Route::get('join/create/{id}', [
        'as' => 'join.create',
        'middleware' => ['not_joined_yet', 'championship_not_finished'],
        'uses' => 'JoinController@index',
    ]);

    Route::post('join/register', [
        'as' => 'join.register',
        'middleware' => ['not_joined_yet', 'has_competition'],
        'uses' => 'JoinController@register',
    ]);

    Route::get('join/{id}', [
        'as' => 'join.show',
        'middleware' => 'join_owner',
        'uses' => 'JoinController@show',
    ]);

    Route::patch('joins/{id}/coupon', [
        'as' => 'join.coupon',
        'middleware' => 'join_owner',
        'uses' => 'CouponsController@apply',
    ]);

    Route::post('join/{id}', [
        'as' => 'join.returned',
        'uses' => 'JoinController@returned',
    ]);
});

// nasp
Route::any('nasp', 'NotificationController@nasp');
Route::get('mercadopago', 'NotificationController@mercadopago');
Route::any('bcash', [
    'as' => 'bcash',
    'uses' => 'NotificationController@bcash',
]);
