<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class JoinForm extends FormValidator {

    protected $rules = [
        'competitions' => 'required',
        'nick' => 'required|min:4'
    ];

    protected $messages = [
        'nick.required' => 'Você esqueceu de preencher o seu nick',
        'competitions.required' => 'Você precisa participar pelo menos de 1 competição'
    ];

}