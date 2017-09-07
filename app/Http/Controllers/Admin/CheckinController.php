<?php

namespace Battleroad\Http\Controllers\Admin;

use App;
use Battleroad\Http\Controllers\BaseController;
use Champ\Join\Repositories\JoinRepository;

class CheckinController extends BaseController
{
    /**
     * Join Repository.
     *
     * @var Champ\Join\Repositories\JoinRepository
     */
    protected $joinRepository;

    public function __construct(JoinRepository $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Check in User Join.
     *
     * @return Illuminate\Http\Response
     */
    public function checkin($id)
    {
        $join = $this->getJoin($id);

        if (!$join) {
            App::abort(404);
        }

        $join->checkin = !$join->checkin;

        $this->joinRepository->save($join);
    }

    /**
     * Find a Join by its id.
     *
     * @param int $id
     *
     * @return Champ\Join\Join
     */
    private function getJoin($id)
    {
        return $this->joinRepository->find($id);
    }
}
