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

    public function authByCode(SocialAuthenticatorListener $listener, $code)
    {
        $googleData = $this->reader->getDataFromCode($code);
        dd($googleData);
    }

}