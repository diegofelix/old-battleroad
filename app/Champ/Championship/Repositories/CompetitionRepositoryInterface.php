<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\RepositoryInterface;

interface CompetitionRepositoryInterface extends RepositoryInterface {

    /**
     * Get all competitions where id in an array
     *
     * @param  array  $ids
     * @return Collection
     */
    public function getByIds(array $ids);
}