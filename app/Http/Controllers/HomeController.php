<?php

namespace Battleroad\Http\Controllers;

class HomeController extends BaseController
{
    /**
     * Show the home to the user.
     *
     * @return Response
     */
    public function index()
    {
        return $this->view('pages.home');
    }

    /**
     * Show a mini tutorial to the user.
     *
     * @return Response
     */
    public function bcash()
    {
        return $this->view('pages.bcash');
    }
}
