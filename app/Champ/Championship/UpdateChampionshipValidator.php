<?php

namespace Champ\Championship;

use Champ\Forms\ChampionshipUpdateForm;

class UpdateChampionshipValidator
{
    /**
     * Update Form Validator.
     *
     * @var ChampionshipUpdateForm
     */
    protected $form;

    public function __construct(ChampionshipUpdateForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'name' => $command->name,
            'description' => $command->description,
        ]);
    }
}
