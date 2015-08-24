<?php

namespace Champ\Join;

use Champ\Forms\EmbededJoinForm;

class EmbededJoinValidator {

    /**
     * Form Validator
     *
     * @var EmbededJoinForm
     */
    protected $form;

    public function __construct(EmbededJoinForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'name' => $command->name,
            'email' => $command->email,
            'email_confirmation' => $command->email_confirmation,
            'competitions' => $command->competitions,
            'nicks' => $command->nicks,
            'identification' => $command->identification
        ]);
    }

}