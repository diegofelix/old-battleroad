<?php

use Laracasts\Commander\CommandBus;
use Champ\Join\Join;
use Champ\Join\JoinCommand;
use Champ\Join\UpdateJoinCommand;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Billing\Core\PaymentListenerInterface;
use Champ\Billing\Pagseguro\Pagseguro;

class JoinController extends BaseController implements PaymentListenerInterface
{

    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Join Repository
     *
     * @var Champ\Join\Repositories\JoinRepositoryInterface
     */
    protected $joinRepository;

    /**
     * Command Bus
     *
     * @var Laracasts\Commander\CommandBus
     */
    protected $commandBus;

    /**
     * Moip Billing
     *
     * @var Pagseguro
     */
    protected $billing;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        JoinRepositoryInterface $joinRepository,
        CommandBus $commandBus,
        Pagseguro $billing
    )
    {
        $this->champRepo = $champRepo;
        $this->joinRepository = $joinRepository;
        $this->commandBus = $commandBus;
        $this->billing = $billing;
    }

    /**
     * Show a form to register to championship
     *
     * @param  int $id
     * @return Response
     */
    public function index($id)
    {
        $championship = $this->champRepo->find($id);

        return $this->view('join.index', compact('championship'));
    }

    /**
     * Subscribe the logged user to the championship
     *
     * @return Response
     */
    public function register()
    {
        $championship = $this->champRepo->find(Input::get('id'));

        $command = new JoinCommand(Auth::user(), $championship, Input::get('competitions'));

        $join = $this->commandBus->execute($command);

        // redirect the user to the location page.
        return $this->redirectRoute('join.show', [$join->id]);
    }

    /**
     * Show all Join data
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $join = $this->findAJoinById($id);

        return $this->view('join.show', compact('join'));
    }

    /**
     * Payment
     *
     * @return Response
     */
    public function payment($id)
    {
        $join = $this->findAJoinById($id);

        return $this->billing->invoice($join, $this);
    }

    /**
     * This method is called by the moip when a payment status is changed,
     * so, when hit here, I have some things to do about
     *
     * @return Response
     */
    public function nasp()
    {
        dd(Input::all());
        extract(Input::all());

        $command = new UpdateJoinCommand(
            $id_transacao,
            $valor,
            $status_pagamento,
            $cod_moip,
            $forma_pagamento,
            $tipo_pagamento,
            $parcelas,
            $email_consumidor,
            $classificacao
        );

        $join = $this->commandBus->execute($command);

        echo 'ok';
    }

    /**
     * This method will be called when the user is allowed to pay
     *
     * @param   $response
     * @return Response
     */
    public function paymentAllowed($response, Join $join)
    {
        $join->token = $response->getCode();

        $this->joinRepository->save($join);

        return $this->redirectTo($response->getRedirectionUrl());
    }

    /**
     * When occurs an error, this method will be called
     *
     * @param   $error
     * @return Response
     */
    public function paymentError($error)
    {
        return $this->redirectBack(['error' => $error]);
    }

    /**
     * Find a joined user by the join id
     *
     * @param  int $id
     * @return Join
     */
    private function findAJoinById($id)
    {
        return $this->joinRepository->find($id, ['Championship', 'items.competition.game']);
    }
}