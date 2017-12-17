<?php

namespace Champ\Composers;

use Champ\Championship\Repository;

class ChampionshipComposer
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
     * Get all available competitions.
     *
     * @param View $view
     */
    public function compose($view)
    {
        $championship = $this->repository->find(request()->segment(3));
        $view->with(compact('championship'));
    }
}
