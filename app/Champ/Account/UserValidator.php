<?php namespace Champ\Account;

use Champ\Core\Validation\AbstractValidator;
use Champ\Core\Validation\ValidableInterface;

class UserValidator extends AbstractValidator implements ValidableInterface {

    /**
     * Rules for the validator
     *
     * @var array
     */
    protected $rules = array(
        'create' => array(
            'name' => 'required|min:4',
            'username' => 'required|between:5,14|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        )
    );

}