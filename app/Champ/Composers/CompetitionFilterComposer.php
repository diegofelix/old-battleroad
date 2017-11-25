<?php

namespace Champ\Composers;

use Champ\Championship\Repository;

class CompetitionFilterComposer
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
        $competitions = $this->championshipRepository->getAvailableCompetitions();

        $view->with(compact('competitions'));
    }
}
