<?php

namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class EmbededJoinForm extends FormValidator {

    protected $rules = [
        'name' => 'required',
        'identification' => 'required',
        'email' => 'required',
        // 'competitions' => 'required',
        // 'nicks' => 'required'
    ];

    /*protected $messages = [
        'nicks.required' => 'Você esqueceu de preencher o(s) nick(s)',
        'competitions.required' => 'Você precisa participar pelo menos de 1 competição',
        'email.required' => 'Você precisa digitar um e-mail válido',
        'email.email' => 'Você precisa digitar um e-mail válido',
        'email.confirmed' => 'Os e-mails não correspondem'
    ];*/

}