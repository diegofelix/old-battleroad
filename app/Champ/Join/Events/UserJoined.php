<?php namespace Champ\Join\Events;

use Champ\Join\Join;

class UserJoined {

    public $join;
    public $competitions;
    public $nicks;

    public function __construct(Join $join, $competitions, $nicks)
    {
        $this->join = $join;
        $this->competitions = $competitions;
        $this->nicks = $nicks;
    }

}