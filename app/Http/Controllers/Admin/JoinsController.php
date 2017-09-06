<?php
namespace Battleroad\Http\Controllers\Admin;

use Auth;
use BaseController;

class JoinsController extends BaseController
{
    /**
     * Show a screen with your championships and joins.
     *
     * @return Response
     */
    public function index()
    {
        $joins = Auth::user()->joins;

        return $this->view('admin.joins', compact('joins'));
    }
}
