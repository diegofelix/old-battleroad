<?php namespace Champ\Subscription\Repositories;

use Champ\Subscription\Subscription;
use Champ\Repositories\Core\AbstractRepository;

class SubscriptionRepository extends AbstractRepository implements SubscriptionRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Subscription\Subscription $model
     */
    public function __construct(Subscription $model)
    {
        $this->model = $model;
    }

    /**
     * Save a Subscription
     *
     * @param  Subscription   $subscription
     * @return Subscription
     */
    public function save(Subscription $subscription)
    {
        return $subscription->save();
    }
}
