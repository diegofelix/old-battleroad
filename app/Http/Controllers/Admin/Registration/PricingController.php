<?php
namespace Battleroad\Http\Controllers\Admin\Registration;

use Input;

class PricingController extends BaseRegistrationController {

    /**
     * Show a form to define the prices for the championship
     *
     * @param  int $id
     * @return Response
     */
    public function create($id)
    {
        $championship = $this->championshipRepository->find($id);

        return $this->view('admin.register.pricing', compact('championship'));
    }

    /**
     * Store the championship's prices
     *
     * @return Response
     */
    public function store($id)
    {
        dd(Input::get());
        if ( ! $this->championshipRepository->saveLocation(Input::all()))
        {
            return $this->redirectBack()
                ->with('error', $this->championshipRepository->getErrors());
        }

        return $this->redirectRoute('admin.register.games', $id);
    }
}