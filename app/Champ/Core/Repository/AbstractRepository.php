<?php namespace Champ\Core\Repository;

abstract class AbstractRepository {

    /**
     * Errors
     *
     * @var MessageBag
     */
    protected $errors;

    /**
     * Default Image if user has no picture
     *
     * @var string
     */
    protected $defaultPicture = 'images/defaultUser.jpg';

    /**
     * All
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return $this->model->all();
    }

    /**
     * Fimd
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Create
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        if ( ! $this->validator->passes($data)) {
            $this->errors = $this->validator->errors();
            return false;
        }

        // attach a default image to the user
        if (empty($data['picture'])) {
            $data['picture'] = $this->defaultPicture;
        }

        return $this->model->create($data);
    }

    /**
     * Update
     *
     * @param array $data
     * @return boolean
     */
    public function update($id, array $data)
    {
        if ( ! $this->validator->passes($data, 'update')) {
            $this->errors = $this->validator->errors();
            return false;
        }

        return $this->model->find($id)->update($data);
    }

    /**
     * Delete
     *
     * @return boolean
     */
    public function delete($id)
    {
        return $this->model->delete($id);
    }

    /**
     * Get the validation errors
     *
     * @return MessageBag
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * get a model by its key
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Model
     */
    public function getBy($key, $value, $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    /**
     * Get first model by its key
     *
     * @param  string $key
     * @param  mixed $value
     * @param  array  $with
     * @return Model
     */
    public function getFirstBy($key, $value, $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->first();
    }

    /**
     * make Method eager loading itens
     *
     * @param  array  $with
     * @return Query
     */
    public function make($with = array())
    {
        return $this->model->with($with);
    }

}