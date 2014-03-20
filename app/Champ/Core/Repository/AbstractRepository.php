<?php namespace Champ\Core\Repository;

abstract class AbstractRepository {

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
        if( ! $this->validator->passes($data))
        {
            $this->errors = $this->validator->errors();
            return false;
        }

        return $this->model->create($data);
    }

    /**
     * Update
     *
     * @param array $data
     * @return boolean
     */
    public function update(array $data)
    {
        if( ! $this->validator->passes($data, 'update'))
        {
            $this->errors = $this->validator->errors();
            return false;
        }

        return $this->model->update($data);
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

}