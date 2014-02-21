<?php namespace Champ\Social\Google;

use Champ\Account\UserRepositoryInterface;
use Champ\Social\SocialAuthenticatorListener;

class GoogleAuthenticator {

    /**
     * User Repository
     *
     * @var Champ\Account\UserRepositoryInterface
     */
    protected $user;

    /**
     * Google User Data Reader
     *
     * @var Champ\Social\Google\GoogleDataReader
     */
    protected $reader;

    public function __construct(
        UserRepositoryInterface $user,
        GoogleDataReader $reader
    )
    {
        $this->user = $user;
        $this->reader = $reader;
    }

    /**
     * Authenticate an user using Google credentials
     *
     * @param  SocialAuthenticatorListener $listener
     * @param  string                      $code
     * @return Response
     */
    public function authByCode(SocialAuthenticatorListener $listener, $code)
    {
        $googleData = $this->reader->getDataFromCode($code);
        $user = $this->user->getByEmail($googleData['email']);

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