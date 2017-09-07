<?php

namespace Battleroad\Http\Controllers;

namespace Admin;

use Input;
use Laracasts\Commander\CommanderTrait;
use Battleroad\Http\Controllers\BaseController;
use Champ\Championship\Mail\CreateCampaignCommand;
use Champ\Championship\Repositories\ChampionshipRepository;

class MailController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $championshipRepository;

    public function __construct(ChampionshipRepository $championshipRepository)
    {
        $this->championshipRepository = $championshipRepository;
    }

    /**
     * Show a view to view the mails.
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->championshipRepository->find($id);

        return $this->view('admin.championships.mail.index', compact('championship'));
    }

    /**
     * Compose a new message to the subscribed users.
     *
     * @param int $id
     *
     * @return Response
     */
    public function compose($id)
    {
        $championship = $this->championshipRepository->find($id);

        return $this->view('admin.championships.mail.compose', compact('championship'));
    }

    /**
     * Send the campaign.
     *
     * @param int $championshipId
     *
     * @return Response
     */
    public function store($championshipId)
    {
        Input::merge(compact('championshipId'));

        $campaign = $this->execute(CreateCampaignCommand::class);

        return $this->redirectRoute('admin.championships.mail', $championshipId)
            ->with(['message' => 'E-mail enviado com sucesso!']);
    }

    public function summary($id, $campaignId)
    {
        // todo
    }
}
