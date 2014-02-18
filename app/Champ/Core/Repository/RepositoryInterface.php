<?php namespace Champ\Core\Repository;

interface RepositoryInterface {

    /**
     * All
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * Find
     *
     * @param int $id
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Create
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $input);

    /**
     * Update
     *
     * @param array $input
     * @return Illuminate\Database\Eloquent\Model
     */
    public function update(array $input);

    /**
     * Delete
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id);

}