<?php

namespace Champ\Listeners;

use Champ\Championship\Events\CampaignWasCreated;
use Champ\Newsletters\CampaignMaker;
use Laracasts\Commander\Events\EventListener;

class SendCampaigns extends EventListener
{
    /**
     * Campaign Maker
     *
     * @var CampaignMaker
     */
    protected $campaignMaker;

    public function __construct(CampaignMaker $campaignMaker)
    {
        $this->campaignMaker = $campaignMaker;
    }

    public function whenCampaignWasCreated(CampaignWasCreated $event)
    {
        $campaign = $event->campaign;

        $this->campaignMaker->send($campaign->campaign_id);
    }
}