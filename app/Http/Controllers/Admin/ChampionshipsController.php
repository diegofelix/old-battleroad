<?php
namespace Battleroad\Http\Controllers\Admin;

use Auth;
use Input;
use Laracasts\Commander\CommanderTrait;
use Champ\Championship\UpdateBannerCommand;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\UpdateChampionshipCommand;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;

class ChampionshipsController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    public function __construct(ChampionshipRepositoryInterface $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Championships in desc date order.
     *
     * @return Response
     */
    public function index()
    {
        $championships = $this->champRepo->getAllByUser(Auth::user()->id, ['user']);

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
        $championship = $this->champRepo->find($id);

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
        $championship = $this->champRepo->find($id);

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

        $championship = $this->execute(UpdateBannerCommand::class, compact('id', 'image'));

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
        $championship = $this->champRepo->find($id);

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
        $championship = $this->champRepo->find($id, ['joins.user']);
        $waitingList = $this->champRepo->waitingList($championship);

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
        return $this->champRepo->find($id);
    }
}
