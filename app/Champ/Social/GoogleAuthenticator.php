<?php namespace Champ\Social;

use Champ\Account\UserRepositoryInterface;
use Champ\Social\GoogleDataReader;

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
     * @var Champ\Social\GoogleDataReader
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

    public function authByCode(SocialAuthenticatorListener $listener, $code)
    {
    }

}