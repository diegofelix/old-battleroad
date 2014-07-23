<?php

Route::get('join/create/{id}', [
    'as' => 'join.create',
    'uses' => 'JoinController@index',
]);

Route::post('join/register', [
    'as' => 'join.register',
    'uses' => 'JoinController@register'
]);

Route::get('join/{id}', [
    'as' => 'join.show',
    'uses' => 'JoinController@show'
]);
