<?php

namespace Champ\Newsletters;

use Champ\Championship\Championship;

interface CampaignMaker
{
    /**
     * Compose a campaign for a championship mail.
     *
     * @param Championship $championship
     * @param string       $subject
     * @param string       $content
     *
     * @return int id of campaign
     */
    public function composeForChampionship(Championship $championship, $subject, $content);

    /**
     * Send a campaign.
     *
     * @param int $campaignId
     *
     * @return mixed
     */
    public function send($campaignId);

    /**
     * Summary if a specific campaign.
     *
     * @param int $campaignId
     *
     * @return mixed
     */
    public function summary($campaignId);
}
