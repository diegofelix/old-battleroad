<?php
namespace Battleroad\Http\Controllers;

use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepository;
use Champ\Join\UpdateJoinCommand;
use Champ\Join\JoinStatusChangedCommand;
use Laracasts\Commander\CommanderTrait;
use Champ\Join\Status;

class NotificationController extends BaseController
{
    use CommanderTrait;

    /**
     * Bcash statuses.
     *
     * @var array
     */
    protected $statuses = [
        'Em andamento' => Status::IN_PROGRESS,
        'Aprovada' => Status::APPROVED,
        'Concluída' => Status::FINISHED,
        'Disputa' => Status::DISPUTE,
        'Devolvida' => Status::RETURNED,
        'Cancelada' => Status::CANCELLED,
        'Chargeback' => Status::CHARGEBACK,
    ];

    /**
     * Join repository.
     *
     * @var JoinRepository
     */
    protected $joinRepository;

    public function __construct(JoinRepository $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    /**
     * Receives the notification and handle it.
     *
     * @return Response
     */
    /*public function nasp()
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
    }*/

    /**
     * Bcash notification.
     */
    public function bcash()
    {
        Log::info('O Status de uma transação mudou');

        // if input has a pedido means that the item status has changed.
        if (Input::has('pedido')) {
            $join = $this->execute(JoinStatusChangedCommand::class);

            // $join = $this->joinRepository->find(Input::get('pedido'));
            // $join->status_id = $this->statuses[Input::get('status')];
            // $this->joinRepository->save($join);

            Log::info('Status do join: '.$join->id.' alterado com sucesso!');
        }

        if (Input::has('id_pedido')) {
            $join = $this->joinRepository->find(Input::get('id_pedido'));
            $join->token = Input::get('id_transacao');
            $this->joinRepository->save($join);

            Log::info('Status do join: '.$join->id.' alterado com sucesso!');
        }
    }
}
