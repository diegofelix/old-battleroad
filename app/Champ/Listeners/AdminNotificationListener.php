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

        foreach ($joins as $join)
        {
            if ( ! $join->isPaid())
            {
                $join->cancelJoin();
            }
        }

        Log::warning('enviar e-mail pra mim pra mim avisando');
    }

}