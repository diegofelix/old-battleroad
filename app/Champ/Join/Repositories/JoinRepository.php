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
}
