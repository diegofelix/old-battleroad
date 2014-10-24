<?php

use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\UpdateJoinCommand;
use Laracasts\Commander\CommanderTrait;

class NotificationController extends BaseController {

    use CommanderTrait;


    /**
     * Bcash statuses
     *
     * @var array
     */
    protected $statuses = [
        'Em andamento' => 2,
        'Aprovada' => 3,
        'Concluída' => 4,
        'Disputa' => 5,
        'Devolvida' => 6,
        'Cancelada' => 7,
        'Chargeback' => 8,
    ];

    /**
     * Join repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Receives the notification and handle it
     *
     * @return Response
     */
    public function nasp()
    {
        $join = $this->execute(UpdateJoinCommand::class);

        Log::info('Join updated');
    }

    public function mercadopago()
    {
        Log::info('Recebeu alguma notificacao aqui');

        $id = Input::get('id');

        $marketplace = App::make('Champ\Billing\MercadoPago\Marketplace');

        $paymentInfo = $marketplace->getPayment($id);

        Log::info($paymentInfo);
    }

    /**
     * Bcash notification
     *
     * @return void
     */
    public function bcash()
    {
        Log::info('O Status de uma transação mudou');
        Log::info(Input::get());

        // if input has a transacao_id means that is item that changed his status.
        if (Input::has('pedido'))
        {
            $join = $this->joinRepository->find(Input::get('pedido'));
            $join->status_id = $this->statuses[Input::get('status')];
            $this->joinRepository->save($join);

            Log::info('Status do join: ' . $join->id . ' alterado com sucesso!');

            // $transaction = $join->findTransaction(Input::get('transacao_id'));

            // if ( ! empty($transaction))
            // {
            //     // change his status
            //     $transaction->status_id =
            //     $transaction->save();

            //     Log::info('Status da transacao: ' .$transaction->transaction_id. ' alterado com sucesso!');
            // }
        }

        // if input has a pedido_id means is a transaction that maybe
        // was not paid or paid in another way. for example:
        // the user clicked in "pay" twice, but just in the second time he effectvly paid.
        if (Input::has('id_pedido'))
        {
            $join = $this->joinRepository->find(Input::get('id_pedido'));
            $join->token = Input::get('id_transacao');
            $this->joinRepository->save($join);

            Log::info('Status do join: ' . $join->id . ' alterado com sucesso!');
            // $join->addTransaction(Input::get('id_transacao'));
            // Log::info('adicionada uma transacao.');
        }
    }
}
