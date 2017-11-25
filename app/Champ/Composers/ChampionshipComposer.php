<?php

namespace Champ\Composers;

use Champ\Championship\Repository;
use Request;

class ChampionshipComposer
{
    protected $championshipRepository;

    public function __construct(Repository $repository)
    {
        $this->championshipRepository = $repository;
    }

    /**
     * Get all available competitions.
     *
     * @param View $view
     */
    public function compose($view)
    {
        $championship = $this->championshipRepository->find(Request::segment(3));
        $view->with(compact('championship'));
    }
}
