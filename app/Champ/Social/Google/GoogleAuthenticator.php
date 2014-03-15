<?php namespace Champ\Social\Google;

use Champ\Account\UserRepositoryInterface;
use Champ\Social\SocialAuthenticatorListener;
use Champ\Social\SocialAuthenticator;
use Champ\Social\SocialAuthenticatorListenerInterface;

class GoogleAuthenticator extends SocialAuthenticator {

    /**
     * Inject the Google data reader
     */
    public function __construct(GoogleDataReader $reader)
    {
        $this->reader = $reader;
    }

    /**
     * Auth the user using oAuth
     *
     * @param Champ\Social\SocialAuthenticatorListenerInterface $listener
     * @param string $code token from the oAuth
     */
    public function auth(SocialAuthenticatorListenerInterface $listener, $code)
    {
        $user = $this->authByCode($code);

        if ($user) {
            return $this->loginUser($listener, $user);
        }

        return $this->userNotFound($listener, $googleData);
    }

    /**
     * Use the listener to treat the user found
     *
     * @param  Champ\Social\SocialAuthenticatorListener $listener
     * @param  Champ\Account\User $user
     * @return Response
     */
    public function loginUser($listener, $user)
    {
        if ($user->is_banned) {
            return $listener->userIsBanned($user);
        }

        return $listener->userFound($user);
    }

    /**
     * Use the listener to treat the user not found
     *
     * @param  Champ\Social\SocialAuthenticatorListener $listener
     * @param  array $googleData
     * @return Response
     */
    public function userNotFound($listener, $googleData)
    {
        return $listener->userNotFound($googleData);
    }

}