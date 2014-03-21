<?php namespace Champ\Account;

use Champ\Core\Validation\AbstractValidator;
use Champ\Core\Validation\ValidableInterface;

class UserValidator extends AbstractValidator implements ValidableInterface {

    /**
     * Rules for the validator
     *
     * @var array
     */
    protected $rules = [
        'create' => [
            'name' => 'required|min:4',
            'username' => 'required|between:5,14|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ],
        'update' => [
            'username' => 'required|between:5,14|unique:users'
        ]
    ];

    protected $messages = [
        'unique' => 'Esse :attribute já está sendo utilizado, escolha outro.'
    ];

}