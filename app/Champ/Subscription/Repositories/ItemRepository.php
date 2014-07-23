<?php namespace Champ\Subscription\Repositories;

use Champ\Subscription\Item;
use Champ\Repositories\Core\AbstractRepository;

class ItemRepository extends AbstractRepository implements ItemRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Subscription\Item $model
     */
    public function __construct(Item $model)
    {
        $this->model = $model;
    }

    /**
     * Save an item
     *
     * @param  Item   $item
     * @return Item
     */
    public function save(Item $item)
    {
        return $item->save();
    }
}
