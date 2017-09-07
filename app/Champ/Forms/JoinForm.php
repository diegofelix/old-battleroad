<?php

namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class JoinForm extends FormValidator
{
    protected $rules = [
        'competitions' => 'required',
        'nicks' => 'required',
    ];

    protected $messages = [
        'nicks.required' => 'Você esqueceu de preencher o(s) nick(s)',
        'competitions.required' => 'Você precisa participar pelo menos de 1 competição',
    ];
}
