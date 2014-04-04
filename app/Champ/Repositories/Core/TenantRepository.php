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
        // inject the context in the model
        $data['user_id'] = $this->context->id();
        return parent::create($data);
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