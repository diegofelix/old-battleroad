<?php

namespace Champ\Filters;

use App;
use Auth;
use Champ\Championship\Repository;
use Request;

class ChampionshipOwner
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param Repository $repository
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Garantee that only the owner of the championship can view its championship.
     *
     * @param Route   $route
     * @param Request $request
     *
     * @return mixed
     */
    public function filter($route, $request)
    {
        // get the championship id
        $id = Request::segment(3);

        $championship = $this->repository->find($id);

        if (!$championship->isOwner(Auth::id())) {
            App::abort(404);
        }
    }
}
