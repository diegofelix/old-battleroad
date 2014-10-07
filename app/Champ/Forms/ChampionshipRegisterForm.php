<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class ChampionshipRegisterForm extends FormValidator {

    protected $rules = [
        'name' => 'required|min:5',
        'description' => 'required|min:20',
        'image' => 'required|image',
        'event_start' => 'required|date_format:"d/m/Y"|future_date',
        'location' => 'required',
        'limit' => 'sometimes|numeric'
    ];

}