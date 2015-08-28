<?php namespace Champ\Join\Repositories;

use Champ\Join\WaitingList;
use Champ\Repositories\Core\AbstractRepository;

class WaitingListRepository extends AbstractRepository implements WaitingListRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Join\WaitingList $model
     */
    public function __construct(WaitingList $model)
    {
        $this->model = $model;
    }

    /**
     * Save an WaitingList
     *
     * @param  WaitingList   $waitingList
     * @return WaitingList
     */
    public function save(WaitingList $waitingList)
    {
        return $waitingList->save();
    }
}
