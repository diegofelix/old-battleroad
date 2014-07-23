<?php namespace Champ\Join\Repositories;

use Champ\Join\Join;
use Champ\Repositories\Core\AbstractRepository;

class JoinRepository extends AbstractRepository implements JoinRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Join\Join $model
     */
    public function __construct(Join $model)
    {
        $this->model = $model;
    }

    /**
     * Save a Join
     *
     * @param  Join   $join
     * @return Join
     */
    public function save(Join $join)
    {
        return $join->save();
    }
}
