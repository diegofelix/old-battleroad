<?php
Route::group(['before' => 'auth'], function()
{
    Route::get('join/create/{id}', [
        'as' => 'join.create',
        'before' => 'not_joined_yet|has_vacancy|championship_not_finished',
        'uses' => 'JoinController@index',
    ]);

    Route::post('join/register', [
        'as' => 'join.register',
        'before' => 'not_joined_yet|has_competition|championship_not_finished',
        'uses' => 'JoinController@register'
    ]);

    Route::get('join/{id}', [
        'as' => 'join.show',
        'uses' => 'JoinController@show'
    ]);

    Route::post('join/{id}', [
        'as' => 'join.returned',
        'uses' => 'JoinController@returned'
    ]);

    Route::get('payment/{id}', [
        'as' => 'payment',
        'before' => 'paid_championship',
        'uses' => 'JoinController@payment'
    ]);
});

// nasp
Route::any('nasp', 'NotificationController@nasp');
Route::get('mercadopago', 'NotificationController@mercadopago');
Route::any('bcash', [
    'as' => 'bcash',
    'uses' => 'NotificationController@bcash'
]);