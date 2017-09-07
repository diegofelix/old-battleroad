<?php
namespace Battleroad\Http\Controllers;

use Champ\Championship\Repositories\ChampionshipRepository;
use Champ\Join\EmbededJoinCommand;
use Champ\Join\LimitExceededJoinCommand;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Laracasts\Commander\CommanderTrait;

// use Champ\Billing\Moip\MoipBilling;
//use Champ\Billing\Core\BillingInterface

class EmbededJoinController extends BaseController
{
    use CommanderTrait;

    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $champRepo;

    /**
     * Join Repository.
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(
        ChampionshipRepository $champRepo,
        JoinRepositoryInterface $joinRepository
    ) {
        $this->champRepo = $champRepo;
        $this->joinRepository = $joinRepository;
    }

    /**
     * Show a form to user register and register to the championship.
     *
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->champRepo->findAvailable($id);

        if (is_null($championship)) {
            return $this->championshipFinished();
        }

        return $this->showJoinForm($championship);
    }

    /**
     * Register the user and register him to the championship.
     *
     * @param int $id
     *
     * @return Response
     */
    public function store($id)
    {
        Input::merge(['championship_id' => $id]);

        //if (Input::has('limit_exceeded')) {
        $join = $this->execute(LimitExceededJoinCommand::class);
        $message = '
                Obrigado por sua inscrição.
                O limite de jogadores foi atingido, mas você poderá ser chamado em caso de desistência.
            ';
//        } else {
        //          $join = $this->execute(EmbededJoinCommand::class);
        //        $message = 'Você foi registrado com sucesso! Por favor, aguarde o e-mail de confirmação.';
        //  }

        return $this->redirectRoute('championships.embeded', $id)
            ->with(compact('message'));
    }

    /**
     * Show for the user that this championship was finished.
     *
     * @return Response
     */
    private function championshipFinished()
    {
        return $this->view('championships.embeded.finished');
    }

    /**
     * Show for the user that the joins period expired or has no more vacancies.
     *
     * @return Response
     */
    private function joinsClosed()
    {
        return $this->view('championships.embeded.closed');
    }

    /**
     * Show the join form for the user.
     *
     * @param Championship $championship
     *
     * @return Response
     */
    private function showJoinForm($championship)
    {
        return $this->view('championships.embeded.limit_exceeded', compact('championship'));
    }
}
