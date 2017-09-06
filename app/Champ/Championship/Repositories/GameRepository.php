<?php namespace Champ\Championship\Repositories;

use Champ\Championship\Game;

class GameRepository implements GameRepositoryInterface
{
    /**
     * Game Model.
     *
     * @var Cham\Championship\Game
     */
    protected $model;

    /**
     * inject the model into constructor.
     *
     * @param Champ\Championship\Game $model
     */
    public function __construct(Game $model)
    {
        $this->model = $model;
    }

    /**
     * Get a list of games.
     *
     * @param int $champId
     *
     * @return array
     */
    public function dropdown()
    {
        return $this->model->lists('name', 'id');
    }
}
