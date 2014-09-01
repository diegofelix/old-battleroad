<?php namespace Admin;

use Auth;
use BaseController;

class DashboardController extends BaseController {

    // /**
    //  * Championship Repository Interface
    //  *
    //  * @var ChampionshipRepositoryInterface
    //  */
    // protected $championshipRepository;

    // public function __construct(ChampionshipRepositoryInterface $championshipRepository)
    // {
    //     $this->championshipRepository = $championshipRepository;
    // }

    /**
     * Show a screen with your championships and joins
     *
     * @return Response
     */
    public function index()
    {
        $championships = Auth::user()->championships;
        $joins = Auth::user()->joins;

        return $this->view('admin.dashboard', compact('championships', 'joins'));
    }

}