<?php
Route::group(['before' => 'auth'], function()
{
    Route::get('join/create/{id}', [
        'as' => 'join.create',
        'before' => 'not_joined_yet',
        'uses' => 'JoinController@index',
    ]);

    Route::post('join/register', [
        'as' => 'join.register',
        'before' => 'not_joined_yet',
        'uses' => 'JoinController@register'
    ]);

    Route::get('join/{id}', [
        'as' => 'join.show',
        'uses' => 'JoinController@show'
    ]);

    Route::get('payment/{id}', [
        'as' => 'payment',
        'before' => 'paid_championship',
        'uses' => 'JoinController@payment'
    ]);
});

// nasp
Route::any('nasp', 'NotificationController@nasp');