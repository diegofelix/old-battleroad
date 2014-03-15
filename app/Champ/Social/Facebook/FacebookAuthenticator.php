<?php namespace Champ\Social\Facebook;

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
     * Facebook User Data Reader
     *
     * @var Champ\Social\Facebook\FacebookDataReader
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
     * Authenticate an user using Facebook credentials
     *
     * @param  SocialAuthenticatorListener $listener
     * @param  string                      $code
     * @return Response
     */
    public function authByCode(SocialAuthenticatorListener $listener, $code)
    {
        $facebookData = $this->reader->getDataFromCode($code);
        $user = $this->user->getByEmail($facebookData['email']);

        if ($user) {
            return $this->loginUser($listener, $user);
        }

        return $this->userNotFound($listener, $facebookData);
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
     * @param  array $facebookData
     * @return Response
     */
    public function userNotFound($listener, $facebookData)
    {
        return $listener->userNotFound($facebookData);
    }

}