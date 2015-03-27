<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class ChampionshipRegisterForm extends FormValidator {

    protected $rules = [
        'name' => 'required|min:5',
        'description' => 'required|min:20',
        'image' => 'required|image|max:3000',
        'event_start' => 'required|date_format:"d/m/Y H:i"|future_date',
        'location' => 'required'
    ];

    protected $messages = [
        'image.required' => 'Você precisa fazer o upload de uma imagem.',
        'image' => 'O arquivo precisa ser uma imagem.',
        'image.max' => 'A imagem deve ter no máximo 3MB'
    ];

}