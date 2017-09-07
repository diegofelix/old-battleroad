<?php

namespace Champ\Join;

use Champ\Forms\JoinForm;

class JoinValidator
{
    /**
     * Join Form Validator.
     *
     * @var JoinForm
     */
    protected $form;

    public function __construct(JoinForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'competitions' => $command->competitions,
            'nicks' => $command->nicks,
        ]);
    }
}
