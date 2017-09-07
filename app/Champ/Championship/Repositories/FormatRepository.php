<?php

namespace Champ\Championship\Repositories;

use Champ\Championship\Format;

class FormatRepository
{
    /**
     * Format Model.
     *
     * @var Cham\Championship\Format
     */
    protected $model;

    /**
     * inject the model into constructor.
     *
     * @param Champ\Championship\Format $model
     */
    public function __construct(Format $model)
    {
        $this->model = $model;
    }

    /**
     * Get a list of Formats.
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
