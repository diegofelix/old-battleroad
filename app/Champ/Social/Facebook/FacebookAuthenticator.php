<?php namespace Champ\Social\Facebook;

use Champ\Account\Repositories\UserRepositoryInterface;
use Champ\Social\SocialAuthenticatorListener;
use Champ\Social\SocialAuthenticator;

class FacebookAuthenticator extends SocialAuthenticator {

    /**
     * Inject the Facebook data reader and the User Repository
     */
    public function __construct(
        UserRepositoryInterface $user,
        FacebookDataReader $reader
    )
    {
        $this->user = $user;
        $this->reader = $reader;
    }
}