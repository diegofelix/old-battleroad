<?php

namespace Champ\Join\Events;

use Champ\Join\Join;

class UserJoinedWithCompetitions
{
    public $join;
    public $competitions;

    public function __construct(Join $join, $competitions)
    {
        $this->join = $join;
        $this->competitions = $competitions;
    }
}
