<?php

namespace Champ\Social\Facebook;

use Champ\Account\Repositories\UserRepository;
use Champ\Social\SocialAuthenticator;

class FacebookAuthenticator extends SocialAuthenticator
{
    /**
     * Inject the Facebook data reader and the User Repository.
     */
    public function __construct(
        UserRepository $user,
        FacebookDataReader $reader
    ) {
        $this->user = $user;
        $this->reader = $reader;
    }
}
