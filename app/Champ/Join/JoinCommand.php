<?php namespace Champ\Join;

use Champ\Account\User;
use Champ\Championship\Championship;

class JoinCommand {

    public $user;

    public $championship;

    public $competitions;

    public function __construct(User $user, Championship $championship, $competitions = null)
    {
        $this->user = $user;
        $this->championship = $championship;
        $this->competitions = $competitions;
    }

}