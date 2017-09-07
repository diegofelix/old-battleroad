<?php namespace Champ\Social\Google;

use Champ\Account\Repositories\UserRepository;
use Champ\Social\SocialAuthenticator;

class GoogleAuthenticator extends SocialAuthenticator
{
    /**
     * Inject the Google data reader and the User Repository.
     */
    public function __construct(
        UserRepository $user,
        GoogleDataReader $reader
    ) {
        $this->user = $user;
        $this->reader = $reader;
    }
}
