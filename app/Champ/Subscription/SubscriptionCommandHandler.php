<?php namespace Champ\Subscription;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Champ\Subscription\Subscription;
use Champ\Subscription\Repositories\SubscriptionRepositoryInterface;
use Champ\Subscription\Repositories\ItemRepositoryInterface;
use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use App;

class SubscriptionCommandHandler implements CommandHandler {

    /**
     * Subscription Repository
     */
    protected $subscriptionRepo;

    /**
     * Competition Repository
     */
    protected $competitionRepo;

    /**
     * Competition Repository
     */
    protected $itemRepo;

    public function __construct(
        SubscriptionRepositoryInterface $subscriptionRepo,
        CompetitionRepositoryInterface $competitionRepo,
        ItemRepositoryInterface $itemRepo
    )
    {
        $this->subscriptionRepo = $subscriptionRepo;
        $this->competitionRepo  = $competitionRepo;
        $this->itemRepo         = $itemRepo;
    }

    public function handle($command)
    {
        // register a subscription
        $subscription = $this->registerSubscription($command);

        // add the competitions
        $this->registerCompetitions($subscription, $command);

        return $subscription;
    }

    /**
     * Register a subscription
     *
     * @param  Command $command
     * @return Subscription
     */
    private function registerSubscription($command)
    {
        $subscription = Subscription::register(
            $command->user->id,
            $command->championship->id,
            $command->championship->price
        );

        $this->subscriptionRepo->save($subscription);

        return $subscription;
    }

    /**
     * Pass through all competitions and create a subscription item
     *
     * @param  Subscription $subscription
     * @param  Command $command
     * @return void
     */
    private function registerCompetitions($subscription, $command)
    {
        foreach ($command->competitions as $competition)
        {
            $competition = $this->competitionRepo->find($competition);

            $item = $subscription->addItem($competition->id, $competition->price);

            $this->itemRepo->save($item);
        }
    }
}