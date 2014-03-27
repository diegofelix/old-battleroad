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
    public function update($id, array $input);

    /**
     * Delete
     *
     * @param int $id
     * @return boolean
     */
    public function delete($id);

    /**
     * get a model by its key
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Model
     */
    public function getBy($key, $value, $with = array());

    /**
     * Get first model by its key
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Model
     */
    public function getFirstBy($key, $value, $with = array());

    /**
     * make Method eager loading itens
     *
     * @param  array  $with
     * @return Query
     */
    public function make($with = array());

}