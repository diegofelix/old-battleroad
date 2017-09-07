<?php

namespace Battleroad\Http\Controllers;

class PagesController extends BaseController
{
    /**
     * Show two options to the user choose.
     *
     * @return Response
     */
    public function howItWorks()
    {
        return $this->view('pages/how_it_works');
    }

    /**
     * How this site works for the organizer?
     *
     * @return Response
     */
    public function organizer()
    {
        return $this->view('pages/how_organizer');
    }

    /**
     * How this site works for the player?
     *
     * @return Response
     */
    public function player()
    {
        return $this->view('pages/how_player');
    }

    /**
     * Change log page.
     *
     * @return Response
     */
    public function changelog()
    {
        return $this->view('pages/changelog');
    }
}
