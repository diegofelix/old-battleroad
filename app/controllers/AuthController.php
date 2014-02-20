<?php

class AuthController extends BaseController {

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

}