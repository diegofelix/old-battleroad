<?php

use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\UpdateJoinCommand;
use Laracasts\Commander\CommanderTrait;
use Log;

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

        if (Input::has('transacao_id'))
        {
            // get the join
            $join = $this->joinRepository->findByToken(Input::get('transacao_id'));

            if ( ! is_null($join)
            {
                // change his status
                $join->status_id = $this->statuses[Input::get('status')];

                // save it
                $this->joinRepository->save($join);

                Log::info('Status alterado com sucesso!');
            }
            else
            {
                Log::warning('Join não encontrado');
            }
        }
    }
}
