<?php

use Champ\Championship\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController {

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

        return $this->view('championships.index', compact('championships'));
    }

    public function create()
    {
        return $this->view('championships.create');
    }

    public function store()
    {
        if ( ! $this->champRepo->createForUser(Auth::user()->id, Input::all())) {
            dd($this->champRepo->getErrors());
        }

        dd('Champ Created boy!');
    }

}