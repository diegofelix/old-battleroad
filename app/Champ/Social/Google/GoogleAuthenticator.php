<?php namespace Champ\Social\Google;

use Champ\Account\UserRepositoryInterface;
use Champ\Social\SocialAuthenticatorListener;
use Champ\Social\SocialAuthenticator;

class GoogleAuthenticator extends SocialAuthenticator {

    /**
     * Inject the Google data reader and the User Repository
     */
    public function __construct(
        UserRepositoryInterface $user,
        GoogleDataReader $reader
    )
    {
        $this->user = $user;
        $this->reader = $reader;
    }
}