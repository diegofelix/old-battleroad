<?php

namespace Battleroad\Http\Controllers\Admin;

use Battleroad\Http\Controllers\BaseController;
use Champ\Join\Repositories\JoinRepository;
use Champ\Championship\Repository;

class CompetitionsController extends BaseController
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Join Repository.
     *
     * @var JoinRepository
     */
    protected $joinRepository;

    /**
     * Class constructor.
     *
     * @param Repository     $repository
     * @param JoinRepository $joinRepository
     */
    public function __construct(
        Repository $repository,
        JoinRepository $joinRepository
    ) {
        $this->repository = $repository;
        $this->joinRepository = $joinRepository;
    }

    /**
     * Show a list of Games for the championship given.
     *
     * @param int $champId
     *
     * @return Response
     */
    public function index($champId)
    {
        $competitions = $this->repository->getCompetitionsByChampionship($champId);

        return $this->view('admin.championships.games.index', compact('competitions'));
    }

    /**
     * Show all details for the competition.
     *
     * @param int $champId
     * @param int $competitionId
     *
     * @return Illuminate\Http\Response
     */
    public function show($champId, $competitionId)
    {
        $competition = $this->repository->findCompetition($competitionId);
        $joins = $this->joinRepository->getByCompetition($competitionId, ['user']);

        return $this->view('admin.championships.games.show', compact('competition', 'joins'));
    }
}
