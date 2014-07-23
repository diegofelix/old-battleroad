<?php

Route::get('subscription/create/{id}', [
    'as' => 'subscription.create',
    'uses' => 'SubscriptionController@index',
]);

Route::post('subscription/register', [
    'as' => 'subscription.register',
    'uses' => 'SubscriptionController@register'
]);

Route::get('subscription/{id}', [
    'as' => 'subscription.show',
    'uses' => 'SubscriptionController@show'
]);
