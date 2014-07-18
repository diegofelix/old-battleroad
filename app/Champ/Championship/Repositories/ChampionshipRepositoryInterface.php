<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface ChampionshipRepositoryInterface extends RepositoryInterface {

    /**
     * Get a list of Championships in event_start desc order
     *
     * @return Paginator
     */
    public function featured();

    /**
     * Publish a championship
     *
     * @param  int $id
     * @return bool
     */
    public function publish($id);

    /**
     * Return a competition by a champ id
     *
     * @param  int $champId
     * @param  int $competitionId
     * @return Model
     */
    public function getCompetition($champId, $competitionId);

}