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
}