<?php namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class ApplyCouponForm extends FormValidator {

    protected $rules = [
        'price' => 'required|numeric',
    ];

    protected $messages = [
        'required' => 'Você esqueceu de preencher o preço',
        'numeric' => 'Preencha corretamente o preço'
    ];

}