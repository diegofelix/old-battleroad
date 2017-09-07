<?php
namespace Battleroad\Http\Controllers;

use Input;
use Champ\Championship\Repositories\ChampionshipRepository;
use Champ\Join\Repositories\JoinRepository;

class ChampionshipsController extends BaseController
{
    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $champRepo;

    /**
     * Join Repository.
     *
     * @var JoinRepository
     */
    protected $joinRepository;

    /**
     * Billing.
     *
     * @var Billing
     */
    protected $billing;

    public function __construct(
        ChampionshipRepository $champRepo,
        JoinRepository $joinRepository
        // MoipBilling $billing
    ) {
        $this->champRepo = $champRepo;
        $this->joinRepository = $joinRepository;
        // $this->billing = $billing;
    }

    /**
     * Show a list of Championships in desc date order.
     *
     * @return Response
     */
    public function index()
    {
        $game = Input::get('game');
        $championships = $this->champRepo->featured($game);

        return $this->view('championships.index', compact('championships'));
    }

    /**
     * Show all details about the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.show', compact('championship'));
    }

    /**
     * Show a form to register to championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function register($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.register', compact('championship'));
    }
}
