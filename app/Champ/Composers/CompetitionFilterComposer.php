<?php

namespace Champ\Composers;

use Champ\Championship\Repositories\ChampionshipRepository;

class CompetitionFilterComposer
{
    protected $championshipRepository;

    public function __construct(ChampionshipRepository $repository)
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
        $competitions = $this->championshipRepository->getAvailableCompetitions();

        $view->with(compact('competitions'));
    }
}
