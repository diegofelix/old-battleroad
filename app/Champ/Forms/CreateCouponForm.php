<?php

namespace Champ\Forms;

use Laracasts\Validation\FormValidator;

class CreateCouponForm extends FormValidator
{
    protected $rules = [
        'championship_id' => 'required',
        'code' => 'required|unique:coupons',
        'price' => 'required|numeric',
    ];

    protected $messages = [
        'required' => 'Você precisa preencher todos os campos.',
        'unique' => 'O código gerado já existe, clique em gerar novamente',
        'numeric' => 'O preço precisa ser um valor válido',
    ];
}
