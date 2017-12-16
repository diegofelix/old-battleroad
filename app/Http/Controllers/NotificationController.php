<?php

namespace Battleroad\Http\Controllers;

use Champ\Join\Jobs\ChangeJoinStatus;
use Champ\Join\Repositories\JoinRepository;
use Champ\Join\JoinStatusChangedCommand;
use Illuminate\Http\Request;
use Laracasts\Commander\CommanderTrait;
use Champ\Join\Status;
use Log;

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
     * Bcash notification.
     *
     * @param Request $request
     */
    public function bcash(Request $request)
    {
        Log::info('O Status de uma transação mudou');

        // if input has a pedido means that the item status has changed.
        if ($request->has('pedido')) {
            $join = $this->dispatch(new ChangeJoinStatus(
                $request->get('pedido'),
                $request->get('status')
            ));

            Log::info('Status do join: '.$join->id.' alterado com sucesso!');
        }

        if ($request->has('id_pedido')) {
            $join = $this->joinRepository->find($request->get('id_pedido'));
            $join->token = $request->get('id_transacao');
            $this->joinRepository->save($join);

            Log::info('Status do join: '.$join->id.' alterado com sucesso!');
        }
    }
}
