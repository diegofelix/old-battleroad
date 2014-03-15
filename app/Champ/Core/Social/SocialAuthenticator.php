<?php namespace Champ\Core\Social;

use Champ\Social\SocialDataReaderInterface;

abstract class FacebookAuthenticator {

    /**
     * User Repository
     *
     * @var Champ\Account\UserRepositoryInterface
     */
    protected $user;

    /**
     * Social User Data Reader
     *
     * @var Champ\Core\Social\SocialDataReaderInterface
     */
    protected $reader;

    /**
     * Champ\Social\SocialAuthenticatorListener
     */
    protected $listener;

    public function __construct($user = null, $reader = null, $listener = null)
    {
        $this->user = $user;
        $this->reader = $reader;
        $this->listener = $listener;
    }

    /**
     * Authenticate an user using Facebook credentials
     *
     * @param  string $code
     * @return Response
     */
    public function authByCode($code)
    {
        $socialData = $this->reader->getDataFromCode($code);
        $user = $this->user->getByEmail($socialData['email']);

        if ($user) {
            return $this->loginUser($user);
        }

        return $this->userNotFound($socialData);
    }

    /**
     * Use the listener to treat the user found
     *
     * @param  Champ\Account\User $user
     * @return Response
     */
    public function loginUser($user)
    {
        if ($user->is_banned) {
            return $this->listener->userIsBanned($user);
        }

        return $this->listener->userFound($user);
    }

    /**
     * Use the listener to treat the user not found
     *
     * @param  array $socialData
     * @return Response
     */
    public function userNotFound($socialData)
    {
        return $this->listener->userNotFound($socialData);
    }

}