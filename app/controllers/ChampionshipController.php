<?php

use Champ\Championship\ChampionshipRepositoryInterface;

class ChampionshipController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Championship\ChampionshipRepositoryInterface
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

        return $this->view('championship.index', compact('championships'));
    }

}