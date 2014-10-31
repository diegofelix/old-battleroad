<?php namespace Champ\Join;

use Champ\Forms\JoinForm;

class JoinValidator {

    /**
     * Register Form Validator
     *
     * @var ChampionshipRegisterForm
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
        ]);
    }

}