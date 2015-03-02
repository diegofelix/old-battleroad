<?php namespace Champ\Composers;

use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Request;

class ChampionshipComposer {

    protected $championshipRepository;

    public function __construct(ChampionshipRepositoryInterface $repository)
    {
        $this->championshipRepository = $repository;
    }

    /**
     * Get all available competitions
     *
     * @param  View $view
     * @return void
     */
    public function compose($view)
    {
        $championship = $this->championshipRepository->find(Request::segment(3));
        $view->with(compact('championship'));
    }

}