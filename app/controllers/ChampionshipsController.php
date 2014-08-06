<?php

use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Moip\Moip;
//use Champ\Billing\Core\BillingInterface

class ChampionshipsController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    public function __construct(ChampionshipRepositoryInterface $champRepo)
    {
        $this->champRepo = $champRepo;
    }

    /**
     * Show a list of Championships in desc date order
     *
     * @return Response
     */
    public function index()
    {
        $game = Input::get('game');
        $championships = $this->champRepo->featured($game);

        return $this->view('championships.index', compact('championships'));
    }

    /**
     * Show all details about the championship
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.show', compact('championship'));
    }

    /**
     * Show a form to register to championship
     *
     * @param  int $id
     * @return Response
     */
    public function register($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('championships.register', compact('championship'));
    }

    /**
     * Payment
     *
     * @return Response
     */
    public function payment()
    {
        // get the championship
        $championship = $this->champRepo->find(Input::get('id'));

        // get the competitions registered
        $competitions = Input::get('competitions');

        // total price
        $total = $championship->price;

        // moips things
        $moip = new Moip();
        $moip->setEnvironment('test');
        $moip->setCredential(array(
            'key' => getenv('MOIP_KEY'),
            'token' => getenv('MOIP_TOKEN')
        ));

        $moip->setUniqueID(false);
        $moip->setReason('Pagamento: ' . $championship->name);
        $moip->addComission(
            'Valor líquido',
            'diegoflx.oliveira@gmail.com',
            getenv('BILLING_COMISSION'),
            getenv('BILLING_PERCENT'),
            getenv('BILLING_RATE')
        );
        $moip->addMessage('Entrada para o campeonato');
        foreach ($championship->competitions as $competition)
        {
            if (in_array($competition->game_id, $competitions))
            {
                $moip->addMessage('Inscrição: ' . $competition->game->name);
                $total += $competition->price;
            }
        }

        $moip->setValue($total);
        $moip->validate('Basic');
        $moip->send();

        $answer = $moip->getAnswer();

        return ( ! $answer->error)
            ? $this->redirectTo($answer->payment_url)
            : $this->redirectTo('/', ['error' => $answer->error]);

        /*
        $championship = $this->champRepo->find($id);

        $billing = App::make('Champ\Billing\Core\BillingInterface');
        $answer = $billing->pay($championship, Auth::user());

        return ( ! $answer->error)
            ? $this->redirectTo($answer->payment_url)
            : $this->redirectTo('/', ['error' => $answer->error]);
        */
    }
}