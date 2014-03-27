<?php namespace Champ\Account;

use Champ\Core\Validation\AbstractValidator;
use Champ\Core\Validation\ValidableInterface;

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