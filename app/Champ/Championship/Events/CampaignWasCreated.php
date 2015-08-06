<?php

namespace Champ\Championship\Events;

use Champ\Championship\Campaign;

class CampaignWasCreated
{
    public $campaign;

    public function __construct(Campaign $campaign)
    {
        $this->campaign = $campaign;
    }

}