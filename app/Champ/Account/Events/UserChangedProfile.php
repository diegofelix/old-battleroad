<?php namespace Champ\Account\Events;

use Champ\Account\Profile;

class UserChangedProfile
{
    public $profile;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
    }
}
