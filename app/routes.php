<?php

Route::get('google', 'AuthController@google');

Route::get('/', function()
{
    return View::make('hello');
});

Route::get('/diego', function()
{
    $user = App::make('Champ\Account\UserRepositoryInterface');

    $userFound = $user->all();

    dd($userFound);
});