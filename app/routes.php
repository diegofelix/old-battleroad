<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	// get data from input
    $code = Input::get( 'code' );

    // get fb service
    $google = OAuth::consumer( 'Google' );

    // check if code is valid

    // if code is provided get user data and sign in
    if ( !empty( $code ) ) {

        // This was a callback request from facebook, get the token
        $token = $google->requestAccessToken( $code );

        // Send a request with it
        $result = json_decode( $google->request( '/me' ), true );

        $message = 'Your unique facebook user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        echo $message. "<br/>";

        //Var_dump
        //display whole array().
        dd($result);

    }
    // if not ask for permission first
    else {
        // get fb authorization
        $url = $google->getAuthorizationUri();

        // return to facebook login url
        return Redirect::to((string)$url);
        return Response::make()->header( 'Location', (string)$url );
    }
});