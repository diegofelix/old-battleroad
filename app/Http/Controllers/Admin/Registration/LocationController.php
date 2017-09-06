<?php
namespace Battleroad\Http\Controllers\Admin\Registration;

use Input;

class LocationController extends BaseRegistrationController
{
    /**
     * Show a form to create the location for the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function create($id)
    {
        $championship = $this->championshipRepository->find($id);

        return $this->view('admin.register.location', compact('championship'));
    }

    /**
     * Store the championship's location.
     *
     * @return Response
     */
    public function store($id)
    {
        if (!$this->championshipRepository->saveLocation(Input::all())) {
            return $this->redirectBack()
                ->with('error', $this->championshipRepository->getErrors());
        }

        return $this->redirectRoute('admin.register.games', $id);
    }
}
