<?php

use Laracasts\Commander\CommandBus;
use Champ\Subscription\SubscriptionCommand;
use Champ\Championship\Repositories\ChampionshipRepositoryInterface;
use Champ\Subscription\Repositories\SubscriptionRepositoryInterface;

class SubscriptionController extends BaseController
{
    /**
     * Championship Repository
     *
     * @var Champ\Championship\Repositories\ChampionshipRepositoryInterface
     */
    protected $champRepo;

    /**
     * Subscription Repository
     *
     * @var Champ\Subscription\Repositories\SubscriptionRepositoryInterface
     */
    protected $subscriptionRepo;

    /**
     * Command Bus
     *
     * @var Laracasts\Commander\CommandBus
     */
    protected $commandBus;

    public function __construct(
        ChampionshipRepositoryInterface $champRepo,
        SubscriptionRepositoryInterface $subscriptionRepo,
        CommandBus $commandBus
    )
    {
        $this->champRepo = $champRepo;
        $this->subscriptionRepo = $subscriptionRepo;
        $this->commandBus = $commandBus;
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

        return $this->view('subscription.index', compact('championship'));
    }

    /**
     * Subscribe the logged user to the championship
     *
     * @return Response
     */
    public function register()
    {
        $championship = $this->champRepo->find(Input::get('id'));

        $command = new SubscriptionCommand(
            Auth::user(),
            $championship,
            Input::get('competitions')
        );

        $subscription = $this->commandBus->execute($command);

        // redirect the user to the location page.
        return $this->redirectRoute('subscription.show', [$subscription->id]);
    }

    /**
     * Show all Subscription data
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $subscription = $this->subscriptionRepo->find($id);

        return $this->view('subscription.show', compact('subscription'));
    }
}