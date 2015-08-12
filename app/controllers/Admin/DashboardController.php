<?php namespace Admin;

use Auth;
use BaseController;

class DashboardController extends BaseController {

    /**
     * Show a screen with your championships and joins
     *
     * @return Response
     */
    public function index()
    {
        $activeChampionships    = $this->activeChampionships();
        $oldChampionships       = $this->oldChampionships();
        $joins = Auth::user()->joins;

        return $this->view('admin.dashboard', compact('activeChampionships', 'oldChampionships', 'joins'));
    }

    private function activeChampionships()
    {
        return Auth::user()->championships->filter(function($champ) {
            return ! $champ->isFinished();
        });
    }

    private function oldChampionships()
    {
        return Auth::user()->championships->filter(function($champ) {
            return $champ->isFinished();
        });
    }

}