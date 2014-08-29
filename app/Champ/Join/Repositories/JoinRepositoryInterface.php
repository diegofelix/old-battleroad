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
}