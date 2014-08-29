<?php namespace Champ\Join\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Join\Item;

interface ItemRepositoryInterface extends RepositoryInterface
{
    /**
     * Save an item
     *
     * @param  Item   $item
     * @return Item
     */
    public function save(Item $item);

    /**
     * Find a join by the token
     *
     * @param  string $token
     * @return Join
     */
    public function findByToken($token);
}
