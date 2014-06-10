<?php namespace Champ\Repositories\Core;

class TenantRepository extends AbstractRepository {

    /**
     * Create an instance of model
     *
     * @param array $data
     * @return boolean
     */
    public function create(array $data)
    {
        return parent::create($data + ['user_id' => $this->context->id()]);
    }

    /**
     * Create a new instance of the managed model.
     *
     * @param  array  $with
     * @return model
     */
    public function make($with = array())
    {
        $model = parent::make($with);

        return $model->where('user_id', '=', $this->context->id());
    }

}