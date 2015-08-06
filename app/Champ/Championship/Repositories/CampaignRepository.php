<?php

namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Campaign;

class CampaignRepository implements CampaignRepositoryInterface
{
    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    /**
     * Find a Campaign by its id
     *
     * @param  int $id
     * @return Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Saves a Campaign
     *
     * @param  Campaign $campaign
     * @return boolean
     */
    public function save(Campaign $campaign)
    {
        return $campaign->save();
    }
}
