<?php

namespace Champ\Championship\Mail;

class CreateCampaignCommand
{
    public $championshipId;
    public $subject;
    public $body;

    /**
     * Constructor.
     *
     * @param int    $championship_id
     * @param string $subject
     * @param int    $body
     * @param int    $campaignId
     */
    public function __construct($championshipId, $subject, $body)
    {
        $this->championshipId = $championshipId;
        $this->subject = $subject;
        $this->body = $body;
    }
}
