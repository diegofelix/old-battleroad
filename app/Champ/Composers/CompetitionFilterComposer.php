<?php

namespace Champ\Composers;

use Champ\Championship\Repository;

class CompetitionFilterComposer
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
        $competitions = $this->repository->getAvailableCompetitions();

        $view->with(compact('competitions'));
    }
}
