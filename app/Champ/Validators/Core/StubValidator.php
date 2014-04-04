<?php namespace Champ\Validators\Core;

class StubValidator extends AbstractValidator implements ValidableInterface {

    /**
     * Stub Validation rules
     *
     * @var array
     */
    protected $rules = [
        'create' => [
            'username' => 'required|alpha_dash|min:2',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ],
        'update' => [
            'username' => 'required'
        ]
    ];

}