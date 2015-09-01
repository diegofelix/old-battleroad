<?php

namespace Champ\Join;

use Champ\Forms\EmbededJoinForm;

class LimitExceededJoinValidator {

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
	    'birthdate' => $command->birthdate,
            'email' => $command->email,
            'email_confirmation' => $command->email_confirmation,
            'competitions' => $command->competitions,
            'nicks' => $command->nicks,
            'identification' => $command->identification
        ]);
    }

}
