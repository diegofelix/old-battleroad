<?php namespace Champ\Filters;

use Champ\Join\Repositories\JoinRepositoryInterface;
use Request;
use Auth;
use App;

class JoinOwner
{
    /**
     * Join Repository.
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Constructor.
     *
     * @param JoinRepositoryInterface $joinRepository
     */
    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Garantee that only the owner of the join can view its join.
     *
     * @param Route   $route
     * @param Request $request
     *
     * @return mixed
     */
    public function filter($route, $request)
    {
        $id = Request::segment(2);

        $join = $this->joinRepository->find($id);

        if ($join->user_id != Auth::user()->id) {
            App::abort(404);
        }
    }
}
