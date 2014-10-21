<?php

use Champ\Join\Join;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\UpdateJoinCommand;
use Laracasts\Commander\CommanderTrait;
use Log;

class NotificationController extends BaseController {

    use CommanderTrait;

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

    public function bcash()
    {
        Log::info('Recebeu alguma notificacao aqui');
        Log::info(json_encode(Input::all()));
    }
}
