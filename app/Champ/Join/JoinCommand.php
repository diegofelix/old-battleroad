<?php namespace Champ\Join;

use Champ\Account\User;
use Champ\Championship\Championship;

class JoinCommand {

    public $user;

    public $championship;

    public $nicks;

    public $competitions;

    public function __construct(User $user, Championship $championship, $nicks, $competitions)
    {
        $this->user = $user;
        $this->championship = $championship;
        $this->nicks = $nicks;
        $this->competitions = $competitions;
    }

}