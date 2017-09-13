<?php

Route::group(['before' => 'auth'], function () {
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
        'before' => 'join_owner',
        'uses' => 'JoinController@show',
    ]);

    Route::patch('joins/{id}/coupon', [
        'as' => 'join.coupon',
        'before' => 'join_owner',
        'uses' => 'CouponsController@apply',
    ]);

    Route::post('join/{id}', [
        'as' => 'join.returned',
        'uses' => 'JoinController@returned',
    ]);

    Route::get('payment/{id}', [
        'as' => 'payment',
        'before' => 'paid_championship',
        'uses' => 'JoinController@payment',
    ]);
});

// nasp
Route::any('nasp', 'NotificationController@nasp');
Route::get('mercadopago', 'NotificationController@mercadopago');
Route::any('bcash', [
    'as' => 'bcash',
    'uses' => 'NotificationController@bcash',
]);
