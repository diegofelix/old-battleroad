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
     * Show a list of Championships in desc date order.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $game = request()->get('game');
        $championships = $this->repository->featured($game);

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
        $championship = $this->repository->find($id);

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
        $championship = $this->repository->find($id);

        return view('championships.register', compact('championship'));
    }
}
