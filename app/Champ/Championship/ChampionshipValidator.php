<?php namespace Champ\Championship;

use Champ\Core\Validation\AbstractValidator;
use Champ\Core\Validation\ValidableInterface;

class ChampionshipValidator extends AbstractValidator implements ValidableInterface {

    /**
     * Rules for the validator
     *
     * @var array
     */
    protected $rules = [
        'create' => [
            'name' => 'required|min:5',
            'description' => 'required|min:20',
            'image' => 'required|image',
            'location' => 'required|min:10',
            'price' => 'required',
            'event_start' => 'required|date_format:"d/m/Y H:i:s"',
            'event_end' => 'required|date_format:d/m/Y H:i:s'
        ]
    ];

}