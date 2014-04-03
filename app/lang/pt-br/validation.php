<?php

return array(

    "accepted"             => "O campo :attribute precisa ser aceito.",
    "active_url"           => "O campo :attribute não é uma URL válida.",
    "after"                => "O campo :attribute precisa ser uma data depois de :date.",
    "alpha"                => "O campo :attribute pode ter apenas letras.",
    "alpha_dash"           => "O campo :attribute pode ter apenas letras, números e hífens.",
    "alpha_num"            => "O campo :attribute pode ter apenas letras e números.",
    "array"                => "O campo :attribute deve ser uma array.",
    "before"               => "O campo :attribute precisa ser uma data antes de :date.",
    "between"              => array(
        "numeric" => "O campo :attribute deve estar entre :min e :max.",
        "file"    => "O campo :attribute deve estar entre :min e :max kilobytes.",
        "string"  => "O campo :attribute deve estar entre :min e :max caracteres.",
        "array"   => "O campo :attribute deve ter entre :min e :max itens.",
    ),
    "confirmed"            => "O campo :attribute não corresponde.",
    "date"                 => "O campo :attribute não é uma data válida.",
    "date_format"          => "O campo :attribute não condiz com o formato :format.",
    "different"            => "O campo :attribute e :other devem ser diferentes.",
    "digits"               => "O campo :attribute precisa ter :digits digitos.",
    "digits_between"       => "O campo :attribute precisa estar entre :min e :max digitos.",
    "email"                => "O campo :attribute precisa ser um e-mail válido.",
    "exists"               => "O campo :attribute selecionado é inválido.",
    "image"                => "O campo :attribute precisa ser uma imagem.",
    "in"                   => "O campo :attribute é inválido.",
    "integer"              => "O campo :attribute precisa ser um inteiro.",
    "ip"                   => "O campo :attribute precisa ser um IP válido.",
    "max"                  => array(
        "numeric" => "O campo :attribute não pode ser maior que :max.",
        "file"    => "O campo :attribute não pode ser maior que :max kilobytes.",
        "string"  => "O campo :attribute não pode ter mais que :max caracteres.",
        "array"   => "O campo :attribute não pode ter mais que :max itens.",
    ),
    "mimes"                => "O campo :attribute deve ser um arquivo do tipo: :values.",
    "min"                  => array(
        "numeric" => "O campo :attribute deve ser pelo menos :min.",
        "file"    => "O campo :attribute deve ser pelo menos :min kilobytes.",
        "string"  => "O campo :attribute deve ter pelo menos :min caracteres.",
        "array"   => "O campo :attribute deve ter pelo menos :min itens.",
    ),
    "not_in"               => "O campo :attribute selecionado é inválido.",
    "numeric"              => "O campo :attribute precisa ser um número.",
    "regex"                => "O formato do campo :attribute é inválido.",
    "required"             => "O campo :attribute precisa ser preenchido.",
    "required_if"          => "O campo :attribute precisa ser preenchido quando :other é :value.",
    "required_with"        => "O campo :attribute precisa ser preenchido quando :values está presente.",
    "required_without"     => "O campo :attribute precisa ser preenchido quando :values não está presente.",
    "required_without_all" => "O campo :attribute precisa ser preenchido quando nenhum dos :values estão presentes.",
    "same"                 => "O campo :attribute e :other precisam ser iguais.",
    "size"                 => array(
        "numeric" => "O campo :attribute precisa ser :size.",
        "file"    => "O campo :attribute precisa ter :size kilobytes.",
        "string"  => "O campo :attribute precisa ter :size characters.",
        "array"   => "O campo :attribute precisa conter :size itens.",
    ),
    "unique"               => "O campo :attribute já está sendo utilizado.",
    "url"                  => "O campo :attribute é inválido.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => array(),

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => array(
        'username'  => 'nick',
        'zipcode'   => 'CEP',
        'bio'       => 'Biografia',
        'address'   => 'Endereço',
        'number'    => 'Número',
        'city'      => 'Cidade',
        'state'     => 'Estado',
        'phone'     => 'Telefone',
        'image'     => 'Imagem'
    ),

);
