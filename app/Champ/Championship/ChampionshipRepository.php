<?php namespace Champ\Championship;

use Champ\Core\Repository\AbstractRepository;

class ChampionshipRepository extends AbstractRepository implements ChampionshipRepositoryInterface {

    public function __construct(
        Championship $model,
        ChampionshipValidator $validator
    )
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    /**
     * Get a list of Championships in event_start desc order
     *
     * @return Paginator
     */
    public function featured()
    {
        return $this->make(['user'])->orderBy('event_start', 'desc')->paginate();
    }

}