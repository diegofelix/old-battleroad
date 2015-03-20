<?php namespace Champ\Join\Repositories;

use Champ\Repositories\Core\RepositoryInterface;
use Champ\Join\Join;

interface JoinRepositoryInterface extends RepositoryInterface
{
    /**
     * Save a Join
     *
     * @param  Join   $join
     * @return Join
     */
    public function save(Join $join);

    /**
     * Find a join by the token
     *
     * @param  string $token
     * @return Join
     */
    public function findByToken($token);

    /**
     * Get the joins that belongs to a given championship
     *
     * @param  int $championshipId
     * @return Collection
     */
    public function getByChampionship($championshipId);

    /**
     * Get a join that has a Coupon
     *
     * @param  Coupon $coupon
     * @return Join
     */
    public function getByCoupon($coupon);

    /**
     * Get a specific join, but only if he belongs to a championship
     * This method is a constraint to garantee that gets only joins that belongs
     * to a specific championship
     *
     * @param  int $championship_id
     * @param  int $id
     * @param  array $with
     * @return Model
     */
    public function getRelationedWith($championship_id, $id, $with = []);

    /**
     * Get the joins that belongs to a specific competition
     *
     * @param  int $competitionId
     * @param  array $with
     * @return Collection
     */
    public function getByCompetition($competitionId, $with = []);
}
