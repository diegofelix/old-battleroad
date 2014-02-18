<?php namespace Champ\Account;

class GenderRepository implements GenderRepositoryInterface {

    /**
     * Gender Model
     *
     * @var Champ\Account\Gender
     */
    protected $model;

    /**
     * Inject the Gender model
     *
     * @param Champ\Account\Gender $gender
     */
    public function __construct(Gender $gender)
    {
        $this->model = $gender;
    }

    /**
     * Generate an array with id as a key and the name as a value
     *
     * @return array
     */
    public function dropDown()
    {
        return $this->model->lists('name', 'id');
    }

}