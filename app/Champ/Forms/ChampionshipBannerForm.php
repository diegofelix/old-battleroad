<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class ChampionshipBannerForm extends FormValidator
{
    protected $rules = [
        'image' => 'required|image|max:3000',
    ];

    protected $messages = [
        'required' => 'Você precisa fazer o upload de uma imagem.',
        'image' => 'O arquivo precisa ser uma imagem.',
        'max' => 'A imagem deve ter no máximo 3MB',
    ];
}
