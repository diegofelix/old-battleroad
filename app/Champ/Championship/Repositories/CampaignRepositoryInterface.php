<?php

namespace Champ\Championship\Repositories;

use Champ\Championship\Campaign;

interface CampaignRepositoryInterface
{
    /**
     * Find a campaign by its id.
     *
     * @param int $id
     *
     * @return model
     */
    public function find($id);

    /**
     * Saves a Campaign.
     *
     * @param Campaign $campaign
     *
     * @return bool
     */
    public function save(Campaign $campaign);
}
