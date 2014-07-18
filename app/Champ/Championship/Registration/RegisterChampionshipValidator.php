<?php namespace Champ\Championship\Registration;

use Champ\Forms\ChampionshipRegisterForm;

class RegisterChampionshipValidator {

    /**
     * Register Form Validator
     *
     * @var ChampionshipRegisterForm
     */
    protected $form;

    public function __construct(ChampionshipRegisterForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'name'          => $command->name,
            'description'   => $command->description,
            'event_start'   => $command->event_start,
            'image'         => $command->image
        ]);
    }

}