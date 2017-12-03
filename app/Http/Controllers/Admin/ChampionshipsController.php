<?php

namespace Battleroad\Http\Controllers\Admin;

use Auth;
use Champ\Championship\Jobs\UpdateBanner;
use Input;
use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\UpdateChampionshipCommand;
use Champ\Championship\Repository;

class ChampionshipsController extends BaseController
{
    use CommanderTrait;

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
     * @return Response
     */
    public function index()
    {
        $championships = $this->repository->getAllByUser(Auth::user()->id, ['user']);

        return $this->view('admin.championships.index', compact('championships'));
    }

    /**
     * Manage the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->getChampionshipById($id);

        return $this->view('admin.championships.show', compact('championship'));
    }

    /**
     * Updates some informations about the championship.
     *
     * @return Response
     */
    public function edit($id)
    {
        $championship = $this->getChampionshipById($id);

        return $this->view('admin.championships.edit', compact('championship'));
    }

    /**
     * Store the modifications.
     *
     * @return Response
     */
    public function update($id)
    {
        $name = Input::get('name');
        $description = Input::get('description');
        $stream = Input::get('stream');

        $championship = $this->execute(UpdateChampionshipCommand::class, compact('id', 'description', 'name', 'stream'));

        return $this->redirectRoute('admin.championships.show', [$championship->id])
            ->with(['message' => 'Informações atualizadas com sucesso!']);
    }

    /**
     * Show the banner of the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function banner($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.championships.banner', compact('championship'));
    }

    /**
     * Show a form to upload a new banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function editBanner($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.championships.edit_banner', compact('championship'));
    }

    /**
     * Updates the new banner.
     *
     * @param int $id
     *
     * @return Response
     */
    public function updateBanner($id)
    {
        $image = Input::file('image');

        $championship = $this->dispatch(new UpdateBanner($id, $image));

        return $this->redirectRoute('admin.championships.banner', [$championship->id])
            ->with(['message' => 'Banner atualizado com sucesso!']);
    }

    /**
     * Show a message to the user cancelling the championship.
     *
     * @return Response
     */
    public function cancel($id)
    {
        $championship = $this->repository->find($id);

        return $this->view('admin.championships.cancel', compact('championship'));
    }

    /**
     * Show all users that joined the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function users($id)
    {
        $championship = $this->repository->find($id, ['joins.user']);
        $waitingList = $this->repository->waitingList($championship);

        return $this->view('admin.championships.users', compact('championship', 'waitingList'));
    }

    /**
     * Get a championship by id.
     *
     * @param int $id
     *
     * @return Championship
     */
    public function getChampionshipById($id)
    {
        return $this->repository->find($id);
    }
}
