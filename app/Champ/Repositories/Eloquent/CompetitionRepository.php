<?php namespace Champ\Repositories\Eloquent;

use Champ\Championship\Competition;
use Champ\Repositories\CompetitionRepositoryInterface;
use Champ\Repositories\Core\AbstractRepository;

class CompetitionRepository extends AbstractRepository implements CompetitionRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Championship\Competition $model
     */
    public function __construct(Competition $model)
    {
        $this->model = $model;
    }
}
