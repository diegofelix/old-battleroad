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
            'image' => 'required|image',
            'location' => 'required|min:10',
            'price' => 'required',
            'event_start' => 'required|date_format:"d/m/Y"',
        ],
        'update' => [
            'description' => 'required|min:20'
        ]
    ];

}