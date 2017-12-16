<?php
namespace Champ\Join\Events;

use Champ\Join\Join;

class JoinStatusChanged
{
    /**
     * @var Join
     */
    public $join;

    /**
     * @param Join $join
     */
    public function __construct(Join $join)
    {
        $this->join = $join;
    }
}
