<?php

namespace Champ\Join\Events;

use Champ\Join\Join;

class UserJoined
{
    /**
     * @var Join
     */
    public $join;

    /**
     * Class constructor.
     *
     * @param Join $join
     */
    public function __construct(Join $join)
    {
        $this->join = $join;
    }
}
