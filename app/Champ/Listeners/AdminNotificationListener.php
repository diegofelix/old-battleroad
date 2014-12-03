<?php namespace Champ\Listeners;

use Champ\Join\Repositories\JoinRepositoryInterface;
use Config;
use Mail;

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
        $joins = $this->joinRepository->getByChampionship($championship->id);

        $cancelledJoins = [];

        foreach ($joins as $join)
        {
            if ( ! $join->isPaid())
            {
                $cancelledJoins[] = $join->id;
                $join->cancelJoin();
            }
        }

        Mail::send('emails.join_finished', compact('cancelledJoins'), function($message)
        {
            $message->to(Config::get('champ.admin_email'))->subject("Inscrições canceladas.");
        });
    }

}