<?php namespace Admin;

use App;
use BaseController;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Input;

class CheckinController extends BaseController {

    /**
     * Join Repository
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Check in User Join
     *
     * @return Illuminate\Http\Response
     */
    public function checkin($id)
    {
        $join = $this->getJoin($id);

        if ( ! $join) App::abort(404);

        $join->checkin = !$join->checkin;

        $this->joinRepository->save($join);
    }

    /**
     * Find a Join by its id
     *
     * @param  int $id
     * @return Champ\Join\Join
     */
    private function getJoin($id)
    {
        return $this->joinRepository->find($id);
    }

}