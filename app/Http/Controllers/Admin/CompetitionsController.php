<?php

namespace Battleroad\Http\Controllers\Admin;

use Battleroad\Http\Controllers\BaseController;
use Champ\Join\Repositories\JoinRepository;
use Champ\Championship\Repository;

class CompetitionsController extends BaseController
{
    /**
     * Competition Repository.
     *
     * @var Repository
     */
    protected $championships;

    /**
     * Join Repository.
     *
     * @var Champ\Join\Repositories\JoinRepository
     */
    protected $joinRepository;

    public function __construct(
        Repository $championships,
        JoinRepository $joinRepository
    ) {
        $this->championships = $championships;
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
        $competitions = $this->championships->getCompetitionByChampionship($champId);

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
        $competition = $this->championships->find($competitionId);
        $joins = $this->joinRepository->getByCompetition($competitionId, ['user']);

        return $this->view('admin.championships.games.show', compact('competition', 'joins'));
    }
}
