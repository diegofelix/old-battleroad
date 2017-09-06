<?php namespace Champ\Account\Events;

use Champ\Account\User;

class UserSignedUp
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
