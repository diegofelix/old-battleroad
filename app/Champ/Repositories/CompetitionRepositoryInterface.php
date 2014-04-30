<?php namespace Champ\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface CompetitionRepositoryInterface extends RepositoryInterface {

    /**
     * Get all competitions by championship id
     *
     * @param  int $champId
     * @return Illuminate/Support/Collection
     */
    public function getByChampionship($champId);

}