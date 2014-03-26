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
            'username' => 'required|between:5,20|unique:users|alpha_dash',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ],
        'update' => [
            'username' => 'required|between:5,14|unique:users'
        ],
        'createProfile' => [
            'cpf' => 'required|numeric',
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'address' => 'required|min:6',
            'number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required'
        ],
        'updateProfile' => [
            'phone' => 'required',
            'zipcode' => 'required|numeric',
            'address' => 'required|min:6',
            'number' => 'required|numeric',
            'city' => 'required',
            'state' => 'required'
        ]
    ];

    protected $messages = [
        'required' => 'Você esqueceu de preencher o campo :attribute.',
        'unique' => 'Esse :attribute já está sendo utilizado, escolha outro.',
        'alpha_dash' => 'Seu :attribute deve conter apenas letras, números e hífens.',
        'between' => 'Seu nick deve ter entre :min e :max caracteres.',
        'email' => 'Formato de e-mail inválido.',
        'confirmed' => 'As senhas digitadas não são iguais.',
        'numeric' => 'Digite apenas números para o campo :attribute.',
        'min' => 'Digite no mínimo :min caracteres.'
    ];

}