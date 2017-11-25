<?php

namespace Battleroad\Http\Controllers\Admin\Registration;

use Laracasts\Commander\Events\DispatchableTrait;

class PublisherController extends BaseRegistrationController
{
    use DispatchableTrait;

    /**
     * Show all saved data to confirm to the user all steps before publish.
     *
     * @param int $id
     *
     * @return Response
     */
    public function confirmation($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.register.confirmation', compact('championship'));
    }

    /**
     * Publish a championship, but only if the championship have at least
     * one game.
     *
     * @param int $id
     *
     * @return Response
     */
    public function publish($id)
    {
        $championship = $this->repository->find($id);

        // check the count of competitions
        if ($championship->competitions->count() > 0) {
            $championship = $this->repository->publish($id);

            $this->dispatchEventsFor($championship);

            return $this->redirectRoute('admin.championships.show', [$id])
                ->with('message', 'Campeonato publicado!');
        } else {
            return $this->redirectBack()
                ->with('error', 'Você precisa ter pelo menos uma competição pra publicar um campeonato.');
        }
    }
}
