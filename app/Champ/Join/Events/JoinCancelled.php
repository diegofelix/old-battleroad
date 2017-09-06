<?php namespace Champ\Join\Events;

use Champ\Join\Join;

class JoinCancelled
{
    public $join;

    public function __construct(Join $join)
    {
        $this->join = $join;
    }
}
