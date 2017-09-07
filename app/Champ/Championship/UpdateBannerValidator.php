<?php

namespace Champ\Championship;

use Champ\Forms\ChampionshipBannerForm;

class UpdateBannerValidator
{
    /**
     * Form Validator.
     *
     * @var ChampionshipBannerForm
     */
    protected $form;

    public function __construct(ChampionshipBannerForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate(['image' => $command->image]);
    }
}
