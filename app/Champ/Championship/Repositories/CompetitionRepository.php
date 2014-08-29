<?php namespace Champ\Championship\Repositories;

use Champ\Championship\Competition;
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

    /**
     * Get all competitions where id in an array
     *
     * @param  array  $ids
     * @return Collection
     */
    public function getByIds(array $ids)
    {
        return $this->model->whereIn('id', $ids)->get();
    }

    /**
     * Saves a competition
     *
     * @param  Competition $competition
     * @return boolean
     */
    public function save(Competition $competition)
    {
        return $competition->save();
    }
}