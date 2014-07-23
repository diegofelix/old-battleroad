<?php namespace Champ\Subscription\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Subscription\Subscription;

interface SubscriptionRepositoryInterface extends RepositoryInterface
{
    /**
     * Save a Subscription
     *
     * @param  Subscription   $subscription
     * @return Subscription
     */
    public function save(Subscription $subscription);
}
