<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class ChampionshipUpdateForm extends FormValidator {

    protected $rules = [
        'name' => 'required|min:5',
        'description' => 'required|min:20'
    ];

}