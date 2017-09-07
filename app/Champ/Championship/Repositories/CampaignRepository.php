<?php

namespace Champ\Championship\Repositories;

use Champ\Championship\Campaign;

class CampaignRepository
{
    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    /**
     * Find a Campaign by its id.
     *
     * @param int $id
     *
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Saves a Campaign.
     *
     * @param Campaign $campaign
     *
     * @return bool
     */
    public function save(Campaign $campaign)
    {
        return $campaign->save();
    }
}
