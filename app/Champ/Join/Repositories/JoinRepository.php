<?php namespace Champ\Join\Repositories;

use Champ\Join\Join;
use Champ\Repositories\Core\AbstractRepository;

class JoinRepository extends AbstractRepository implements JoinRepositoryInterface {

    /**
     * inject the model into constructor
     *
     * @param Champ\Join\Join $model
     */
    public function __construct(Join $model)
    {
        $this->model = $model;
    }

    /**
     * Save a Join
     *
     * @param  Join   $join
     * @return Join
     */
    public function save(Join $join)
    {
        return $join->save();
    }

    /**
     * Find a join by the token
     *
     * @param  string $token
     * @return Join
     */
    public function findByToken($token)
    {
        return $this->model->whereToken($token)->firstOrFail();
    }

    /**
     * Get the join id by it item
     *
     * @param  int $competitionId
     * @return Model
     */
    public function findByCompetition($competitionId)
    {
        return $this->model->whereHas('items', function($q) use ($competitionId)
        {
            $q->where('id', '=', $competitionId);
        })->first();
    }

    /**
     * Find a transaction by its id
     *
     * @param  int $transactionId
     * @return Transaction
     */
    public function findTransaction($transactionId)
    {
        return $this->model->whereHas('transactions', function($q) use ($transactionId)
        {
            $q->where('transaction_id', '=', $transactionId);
        })->first();
    }

    /**
     * Get the joins that belongs to a given championship
     *
     * @param  int $championshipId
     * @return Collection
     */
    public function getByChampionship($championshipId)
    {
        return $this->model->where('championship_id', $championshipId)
            ->get();
    }

    /**
     * Get a join that has a Coupon
     *
     * @param  Coupon $coupon
     * @return Join
     */
    public function getByCoupon($coupon)
    {
        return $coupon->load('join.items')->join;
    }

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
    public function getRelationedWith($championship_id, $id, $with = [])
    {
        return $this->getFirstWhere(compact('championship_id', 'id'), $with);
    }

    /**
     * Get the joins that belongs to a specific competition
     *
     * @param  int $competitionId
     * @param  array $with
     * @return Collection
     */
    public function getByCompetition($competitionId, $with = [])
    {
        return $this->make($with)->whereHas('items', function($query) use ($competitionId) {
            $query->where('competition_id', $competitionId);
        })->get();
    }

    public function userParticipating($userId, $championshipId)
    {
        // get the join
        $join = $this->model
            ->whereUserId($userId)
            ->whereChampionshipId($championshipId)
            ->first();

        // if was not found
        if (is_null($join)) return false;

        // return if is active or not
        return $join->isActive();
    }
}
