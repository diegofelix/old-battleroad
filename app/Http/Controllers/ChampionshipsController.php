<?php

namespace Battleroad\Http\Controllers;

use Champ\Championship\Repository;

class ChampionshipsController extends BaseController
{
    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $champRepo;

    /**
     * Class constructor.
     *
     * @param Repository $champRepo
     */
    public function __construct(Repository $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Championships in desc date order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = request()->get('game');
        $championships = $this->champRepo->featured($game);

        return view('championships.index', compact('championships'));
    }

    /**
     * Show all details about the championship.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);

        return view('championships.show', compact('championship'));
    }

    /**
     * Show a form to register to championship.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function register($id)
    {
        $championship = $this->champRepo->find($id);

        return view('championships.register', compact('championship'));
    }
}
