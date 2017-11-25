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
    protected $championships;

    public function __construct(Repository $championships)
    {
        $this->championships = $championships;
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

        $championship = $this->championships->find($id);

        if (!$championship->isOwner(Auth::id())) {
            App::abort(404);
        }
    }
}
