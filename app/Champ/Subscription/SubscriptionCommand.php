<?php namespace Champ\Subscription;

use Champ\Account\User;
use Champ\Championship\Championship;

class SubscriptionCommand {

    public $user;

    public $championship;

    public $competitions;

    public function __construct(User $user, Championship $championship, array $competitions = [])
    {
        $this->user = $user;
        $this->championship = $championship;
        $this->competitions = $competitions;
    }

}