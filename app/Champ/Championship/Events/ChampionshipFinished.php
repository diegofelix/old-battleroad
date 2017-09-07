<?php

namespace Champ\Championship\Events;

use Champ\Championship\Championship;

class ChampionshipFinished
{
    public $championship;

    public function __construct(Championship $championship)
    {
        $this->championship = $championship;
    }
}
