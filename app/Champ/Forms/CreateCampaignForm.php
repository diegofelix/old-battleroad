<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class CreateCampaignForm extends FormValidator {

    protected $rules = [
        'championship_id'   => 'required',
        'subject'           => 'required|min:3',
        'body'              => 'required|min:10'
    ];

    protected $messages = [
        'required' => 'Você precisa preencher todos os campos.',
        'subject.min' => 'Campo assunto deve ter no mínimo 3 caracteres.',
        'body.min' => 'Campo mensagem deve ter no mínimo 10 caracteres.'
    ];

}