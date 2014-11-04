<?php Champ\Listeners;

use Champ\Join\Repositories\JoinRepositoryInterface;

class AdminNotificationListener {

    /**
     * Join Repository
     *
     * @var JoinRepositoryInterface
     */
    protected $joinRepository;

    public function __construct(JoinRepositoryInterface $joinRepository)
    {
        $this->joinRepository = $joinRepository;
    }

    public function handle($championship)
    {
        $joins = $this->joinRepository->findByChampionship($championship->id);

        $cancelledJoins = [];

        foreach ($joins as $join)
        {
            if ( ! $join->isPaid())
            {
                $cancelledJoins[] = $join->id;
                $join->cancelJoin();
            }
        }

        Mail::send('emails.join_finished', $parameters, function($message) use ($cancelledJoins)
        {
            $message->to('diegoflx.oliveira@gmail.com')->subject("Inscrições canceladas.");
        });
    }

}