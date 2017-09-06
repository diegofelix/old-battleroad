<?php
namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class CompetitionForm extends FormValidator
{
    protected $rules => [
        'game_id' => 'required',
        'platform_id' => 'required',
        'format' => 'required',
        'price' => 'sometimes|numeric',
        'event_start' => 'required|date_format:"d/m/Y"|future_date',
    ];
}
