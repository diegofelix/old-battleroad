<?php

namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class EmbededJoinForm extends FormValidator {

    protected $rules = [
        'name' => 'required|min:6',
        'birthdate' => 'required|date_format:"d/m/Y"',
        'identification' => 'required',
        'email' => 'required|confirmed',
        'competitions' => 'required|min:1',
        'nicks' => 'required|min:1|array'
    ];

    protected $messages = [
        'name' => 'Você precisa preencher um nome',
        'name.required' => 'Você precisa preencher seu nome completo',
        'name.min' => 'Seu nome e sobrenome precisa ter pelo menos 6 caracteres',
        'birthdate.required' => 'Você precisa preencher sua data de nascimento',
        'birthdate.date_format' => 'O formato da data precisa ser dd/mm/aaaa',
        'identification.required' => 'Você precisa preencher um RG/Passaporte',
        'nicks.required' => 'Você esqueceu de preencher o(s) nick(s)',
        'nicks.min' => 'O campo nickname precisa ter pelo menos 3 caracteres',
        'competitions.required' => 'Você precisa participar pelo menos de 1 competição',
        'email.required' => 'Você precisa digitar um e-mail válido',
        'email.email' => 'Você precisa digitar um e-mail válido',
        'email.confirmed' => 'Os e-mails não correspondem',
    ];

}
