<?php namespace Champ\Join\Events;

use Champ\Join\Join;

class UserJoined {

    public $join;

    public function __construct(Join $join)
    {
        $this->join = $join;
    }

}