<?php

use Champ\Social\SocialAuthenticatorListenerInterface;

class AuthController extends BaseController implements SocialAuthenticatorListenerInterface {

    /**
     * User Entity
     *
     * @var Champ\Account\UserEntityInterface
     */
    protected $user;

    public function __construct(UserEntityInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the Authentication from Google
     *
     * @return Response
     */
    public function google()
    {
        if (Input::has('code')) {
            return App::make('Champ\Social\Google\GoogleAuthenticator')->authByCode($this, Input::get('code'));
        }

        // redirect to the google oAuth
        return $this->redirectTo((string) OAuth::consumer('Google')->getAuthorizationUri());
    }

    /**
     * Handle the Authentication from Facebook
     * 
     * @return Response
     */
    public function facebook()
    {
        if (Input::has('code')) {
            return App::make('Champ\Social\Facebook\FacebookAuthenticator')->authByCode($this, Input::get('code'));
        }

        return $this->redirectTo((string) OAuth::consumer('Facebook')->getAuthorizationUri());
    }

    /**
     * User found listener used in the SocialAuth
     *
     * @param  Champ\Account\User $user
     * @return Response
     */
    public function userFound($user)
    {
        Auth::loginUsingId($user->id);
        return $this->redirectTo('/');
    }

    /**
     * User is Banned
     * This method also can be used in the SocialAuth
     *
     * @param  Champ\Account\User $user
     * @return Response
     */
    public function userIsBanned($user)
    {
        dd($user);
    }

    /**
     * User Not Found Listener used in the SocialAuth
     *
     * @param array data
     * @return Response
     */
    public function userNotFound($data)
    {
        $user = $this->user->createBySocialAuth($data);
        return $this->userFound($user);
    }

}