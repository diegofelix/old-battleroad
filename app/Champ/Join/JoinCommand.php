<?php namespace Champ\Join;

use Champ\Account\User;
use Champ\Championship\Championship;

class JoinCommand {

    public $user;

    public $championship;

    public $nick;

    public $competitions;

    public function __construct(User $user, Championship $championship, $nick, $competitions = null)
    {
        $this->user = $user;
        $this->championship = $championship;
        $this->nick = $nick;
        $this->competitions = $competitions;
    }

}