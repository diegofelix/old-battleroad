<?php

use Champ\Repositories\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    public function __construct(ChampionshipRepositoryInterface $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Championships in desc date order
     *
     * @return Response
     */
    public function index()
    {
        $championships = $this->champRepo->featured();

        return $this->view('championships.index', compact('championships'));
    }

    /**
     * Show all details about the championship
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.show', compact('championship'));
    }
}