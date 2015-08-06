<?php

namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Championship\Campaign;

interface CampaignRepositoryInterface
{

    /**
     * Find a campaign by its id
     *
     * @param  int $id
     * @return model
     */
    public function find($id);

    /**
     * Saves a Campaign
     *
     * @param  Campaign $campaign
     * @return boolean
     */
    public function save(Campaign $campaign);
}