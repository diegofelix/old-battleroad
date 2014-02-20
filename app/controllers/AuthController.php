<?php

use Champ\Social\SocialAuthenticatorListener;

class AuthController extends BaseController implements SocialAuthenticatorListener {

    public function __construct()
    {

    }

    public function google()
    {
        if (Input::has('code'))
        {
            return App::make('Champ\Social\Google\GoogleAuthenticator')->authByCode($this, Input::get('code'));
        }

        // redirect to the google oAuth
        return $this->redirectTo((string) OAuth::consumer('Google')->getAuthorizationUri());
    }

    public function userFound($user)
    {

    }

    public function userIsBanned($user)
    {

    }

}