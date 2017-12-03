<?php

namespace Champ\Repositories\Core;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     * Errors.
     *
     * @var MessageBag
     */
    protected $errors;

    /**
     * @var Model
     */
    protected $model;

    /**
     * Class constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get the first instance of a model.
     *
     * @param array $with
     *
     * @return Model
     */
    public function first($with = array())
    {
        return $this->make($with)->first();
    }

    /**
     * Returns a list of all models.
     *
     * @return Collection
     */
    public function all($with = array())
    {
        return $this->make($with)->get();
    }

    /**
     * Find a model by its id.
     *
     * @return Model
     */
    public function find($id, $with = array())
    {
        return $this->make($with)->findOrFail($id);
    }

    /**
     * Create.
     *
     * @param array $data
     *
     * @return bool
     */
    public function create(array $data)
    {
        if (!$this->validator->passes($data)) {
            $this->errors = $this->validator->errors();

            return false;
        }

        return $this->model->create($data);
    }

    /**
     * Update.
     *
     * @param array $data
     *
     * @return bool
     */
    public function update($id, array $data)
    {
        if (!$this->validator->passes($data, 'update')) {
            $this->errors = $this->validator->errors();

            return false;
        }

        return $this->model->find($id)->update($data);
    }

    /**
     * Deletes a model by its id.
     *
     * @return bool
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }

    /**
     * Get the validation errors.
     *
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * get a model by its key.
     *
     * @param string $key
     * @param mixed  $value
     * @param array  $with
     *
     * @return Model
     */
    public function getBy($key, $value, $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Get first model by its key.
     *
     * @param string $key
     * @param mixed  $value
     * @param array  $with
     *
     * @return Model
     */
    public function getFirstBy($key, $value, $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->first();
    }

    /**
     * make Method eager loading itens.
     *
     * @param array $with
     *
     * @return Query
     */
    protected function make($with = array())
    {
        return $this->model->with($with);
    }

    /**
     * Get first for a Specific match.
     *
     * @param array $where
     * @param array $with
     *
     * @return Model
     */
    public function getFirstWhere($where = [], $with = [])
    {
        return $this->model->with($with)->where($where)->first();
    }

    /**
     * Get a Specific match.
     *
     * @param array $where
     * @param array $with
     *
     * @return Collection
     */
    public function getWhere($where = [], $with = [])
    {
        return $this->model->with($with)->where($where)->get();
    }
}
