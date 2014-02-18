<?php namespace Champ\Core\Entity;

interface EntityInterface {

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

    /**
     * Errors
     *
     * @return Illuminate\Support\MessageBag
     */
    public function errors();

}