<?php namespace Champ\Composers;

use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class CompetitionFilterComposer {

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
        $competitions = $this->championshipRepository->getAvailableCompetitions();

        $view->with(compact('competitions'));
    }

}