<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Championship\Championship;

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
     * Save the location and price for the championship
     *
     * @param  array $input
     * @return mixed
     */
    public function saveLocation($input);

    /**
     * Create a new competition and attach to the championship
     *
     * @param  int $champId
     * @param  array $data
     * @return mixed
     */
    public function createCompetition($champId, $data);

    /**
     * Save a championship
     *
     * @param  Championship $championship
     * @return mixed
     */
    public function save(Championship $championship);

    /**
     * Return a competition by a champ id
     *
     * @param  int $champId
     * @param  int $competitionId
     * @return Model
     */
    public function getCompetition($champId, $competitionId);

    /**
     * Get all championships for the user
     *
     * @param  int $id
     * @param  array $with
     * @return Collectino
     */
    public function getAllByUser($id, $with);

}