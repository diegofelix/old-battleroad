<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class JoinForm extends FormValidator {

    protected $rules = [
        'competitions' => 'required',
    ];

    protected $messages = [
        'required' => 'Você precisa participar pelo menos de 1 competição'
    ];

}