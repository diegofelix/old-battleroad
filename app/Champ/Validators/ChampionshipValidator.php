<?php namespace Champ\Validators;

use Champ\Validators\Core\AbstractValidator;
use Champ\Validators\Core\ValidableInterface;

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
            'event_start' => 'required|date_format:"d/m/Y"',
        ],
        'location' => [
            'location' => 'required',
            'price' => 'sometimes|numeric',
            'limit' => 'sometimes|numeric'
        ],
        'update' => [
            'description' => 'required|min:20'
        ]
    ];

}