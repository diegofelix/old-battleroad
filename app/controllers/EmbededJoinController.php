<?php

use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\EmbededJoinCommand;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Laracasts\Commander\CommanderTrait;
// use Champ\Billing\Moip\MoipBilling;
//use Champ\Billing\Core\BillingInterface

class EmbededJoinController extends BaseController {

    use CommanderTrait;

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Join Repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        JoinRepositoryInterface $joinRepository
    ) {
        $this->champRepo = $champRepo;
        $this->joinRepository = $joinRepository;
    }

    /**
     * Show a form to user register and register to the championship
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->champRepo->findAvailable($id);

        if (is_null($championship)) {
            return $this->championshipFinished();
        }

        if ($championship->hasAvailableCompetitions()) {
            return $this->showJoinForm($championship);
        }

        return $this->joinsClosed();
    }

    /**
     * Register the user and register him to the championship
     *
     * @param  int $id
     * @return Response
     */
    public function store($id)
    {
        Input::merge(['championship_id' => $id]);

        $join = $this->execute(EmbededJoinCommand::class);

        return $this->redirectRoute('championships.embeded', $id)
            ->with(['message' => 'Você foi registrado com sucesso!']);
    }

    /**
     * Show for the user that this championship was finished
     *
     * @return Response
     */
    private function championshipFinished()
    {
        return $this->view('championships.embeded.finished');
    }

    /**
     * Show for the user that the joins period expired or has no more vacancies
     *
     * @return Response
     */
    private function joinsClosed()
    {
        return $this->view('championships.embeded.closed');
    }

    /**
     * Show the join form for the user
     *
     * @param  Championship $championship
     * @return Response
     */
    private function showJoinForm($championship)
    {
        return $this->view('championships.embeded.available', compact('championship'));
    }
}