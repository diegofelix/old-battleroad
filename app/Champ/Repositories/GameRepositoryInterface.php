<?php namespace Champ\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface GameRepositoryInterface {

    /**
     * Get a list of games
     *
     * @param  int $champId
     * @return array
     */
    public function dropdown();

}