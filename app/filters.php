<?php

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/

App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/

Route::filter('auth', function()
{
    if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});

/*
|--------------------------------------------------------------------------
| No Profile Filter
|--------------------------------------------------------------------------
|
| The No Profile is responsible for check if the user has a profile.
| Without a profile, the user canot create a championship nor
| register to a one.
|
*/

Route::filter('no_profile', function()
{
    if (Auth::user()->profile)
    {
        return Redirect::to('/');
    }
});


Route::filter('championship_not_published', function($request)
{
    $id = $request->getParameter('register');

    if (Champ\Championship\Championship::checkPublished($id))
    {
        return Redirect::to('/')
            ->withError('Você não pode alterar um campeonato já publicado');
    }
});

Route::filter('championship_published', function($request)
{
    $id = $request->getParameter('id');

    if ( ! Champ\Championship\Championship::checkPublished($id))
    {
        return Redirect::route('admin.register.location', $id)
            ->withError('Esse campeonato ainda não publicado, termine de registra-lo.');
    }
});

/*
|--------------------------------------------------------------------------
| Moip user filter
|--------------------------------------------------------------------------
|
| This filter is responsible for check if the user has a moip_user.
| Without it he cant register a championship.
|
*/

Route::filter('has_moip', function()
{
    if ( ! Auth::user()->profile)
    {
        return Redirect::route('profile.create')
            ->withError('Preencha seu perfil com seus dados e sua conta MOIP antes de registrar um campeonato.');
    }

    if ( ! Auth::user()->profile->moip_user)
    {
        return Redirect::route('profile.edit', Auth::user()->username)
            ->withError('Você precisa ter uma conta MOIP antes. Preencha seu login MOIP no seu perfil.');
    }
});