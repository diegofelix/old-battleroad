<?php

namespace Champ\Join\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Join\WaitingList;

interface WaitingListRepositoryInterface extends RepositoryInterface
{
    /**
     * Save an WaitingList
     *
     * @param  WaitingList   $waitingList
     * @return WaitingList
     */
    public function save(WaitingList $waitingList);
}
