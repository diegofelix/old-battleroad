<?php

use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Moip\Moip;
//use Champ\Billing\Core\BillingInterface

class ChampionshipsController extends BaseController {

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    protected $joinRepository;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        JoinRepositoryInterface $joinRepository
    )
    {
        $this->champRepo = $champRepo;
        $this->joinRepository = $joinRepository;
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
    public function payment($id)
    {
        // get the championship
        $join = $this->joinRepository->find($id, ['championship', 'items.competition']);

        // total price
        $total = $join->price;

        // moips things
        $moip = new Moip();
        $moip->setEnvironment('test');
        $moip->setCredential(array(
            'key' => getenv('MOIP_KEY'),
            'token' => getenv('MOIP_TOKEN')
        ));
        $moip->setUniqueID('p'.$join->id);
        $moip->setReason('Pagamento: ' . $join->championship->name);
        $moip->addComission(
            'Valor líquido',
            $join->championship->user->profile->moip_user,
            100 - Config::get('champ.rate'), // 91%
            true,
            false
        );
        $moip->addMessage('Entrada: ' . $join->championship->name);
        foreach ($join->items as $item)
        {
            $moip->addMessage('Inscrição: ' . $item->competition->game->name);
            $total += $item->price;
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

    public function moipReturn()
    {
        dd(Input::all());
    }
}