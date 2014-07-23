<?php namespace Champ\Subscription\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Subscription\Item;

interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * Save an item
     *
     * @param  Item   $item
     * @return Item
     */
    public function save(Item $item);
}
