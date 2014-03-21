<?php

// Handle the authentication
Route::get('login', ['as' => 'session.create', 'uses' => 'SessionController@create']);
Route::get('logout', ['as' => 'session.destroy', 'uses' => 'SessionController@destroy']);
Route::post('login', ['as' => 'session.store', 'uses' => 'SessionController@store']);

Route::get('google', ['as' => 'auth.google', 'uses' => 'AuthController@google']);
Route::get('facebook', ['as' => 'auth.facebook', 'uses' => 'AuthController@facebook']);

// home routes
Route::get('/', 'HomeController@index');
Route::get('how-it-works', [
    'as' => 'home.how_it_works',
    'uses' => 'HomeController@howItWorks'
]);

// profile route
Route::resource('profile', 'ProfileController');

// register
Route::get('register', ['as' => 'register.index', 'uses' => 'RegisterController@index']);
Route::post('register', ['as' => 'register.store', 'uses' => 'RegisterController@store']);

/*
Route::get('moip', function(){

    $moip = new Moip\Moip;
    $moip->setEnvironment('test');
    $moip->setCredential(array(
        'key' => 'H980Q22VM3W6LC6LIQIA8JVQTUKF1E1ONH4VL3QC',
        'token' => 'ZOYXSPWPYR5ZEGYPGQVRKO9I58JA6CLU'
        ));

    $moip->setUniqueID(false);
    $moip->setValue('100.00');
    $moip->setReason('Thiago é muito ruim no Street, só ganha no Tekken!');

    $moip->validate('Basic');

    $moip->send();

    $response = $moip->getAnswer()->response;
    $token = $moip->getAnswer()->token;

    return Redirect::to($moip->getAnswer()->payment_url);

});

Route::get('/diego', function()
{
    $user = App::make('Champ\Account\UserRepositoryInterface');

    $userFound = $user->all();

    dd($userFound);
});
*/