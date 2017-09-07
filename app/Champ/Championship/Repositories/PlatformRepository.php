<?php

namespace Champ\Championship\Repositories;

use Champ\Championship\Platform;

class PlatformRepository
{
    /**
     * Platform Model.
     *
     * @var Cham\Championship\Platform
     */
    protected $model;

    /**
     * inject the model into constructor.
     *
     * @param Champ\Championship\Platform $model
     */
    public function __construct(Platform $model)
    {
        $this->model = $model;
    }

    /**
     * Get a list of Platforms.
     *
     * @param int $champId
     *
     * @return array
     */
    public function dropdown()
    {
        return $this->model->lists('name', 'id');
    }
}
