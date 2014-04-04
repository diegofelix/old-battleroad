<?php namespace Champ\Validators;

use Champ\Validators\Core\AbstractValidator;
use Champ\Validators\Core\ValidableInterface;

class ProfileValidator extends AbstractValidator implements ValidableInterface {

    /**
     * Rules for the validator
     *
     * @var array
     */
    protected $rules = [
        'create' => [
            'cpf' => 'required|numeric',
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'address' => 'required|min:6',
            'number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required'
        ],
        'update' => [
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'address' => 'required|min:6',
            'number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required'
        ]
    ];

}