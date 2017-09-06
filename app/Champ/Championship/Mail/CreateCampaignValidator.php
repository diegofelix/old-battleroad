<?php

namespace Champ\Championship\Mail;

use Champ\Forms\CreateCampaignForm;

class CreateCampaignValidator
{
    /**
     * Register Form Validator.
     *
     * @var CreateCampaignForm
     */
    protected $form;

    public function __construct(CreateCampaignForm $form)
    {
        $this->form = $form;
    }

    public function validate($command)
    {
        $this->form->validate([
            'championship_id' => $command->championshipId,
            'subject' => $command->subject,
            'body' => $command->body,
        ]);
    }
}
