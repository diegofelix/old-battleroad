<?php

namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class RegisterForm extends FormValidator
{
    protected $rules = [
        'name' => 'required|min:4',
        'username' => 'required|between:5,20|unique:users|alpha_dash',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed',
    ];
}
