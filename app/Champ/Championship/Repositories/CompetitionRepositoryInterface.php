<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Championship\Competition;

interface CompetitionRepositoryInterface extends RepositoryInterface {

    /**
     * Get all competitions where id in an array
     *
     * @param  array  $ids
     * @return Collection
     */
    public function getByIds(array $ids);

    /**
     * Saves a competition
     *
     * @param  Competition $competition
     * @return boolean
     */
    public function save(Competition $competition);

    /**
     * Get competitions by the championship id
     *
     * @param  id $championshipId
     * @param  array $with
     * @return Collection
     */
    public function getByChampionship($championshipId, $with = []);
}