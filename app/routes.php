<?php

Route::get('google', 'AuthController@google');

Route::get('/', function()
{
    return View::make('hello');
});