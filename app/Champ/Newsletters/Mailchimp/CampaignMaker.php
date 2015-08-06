<?php

namespace Champ\Newsletters\Mailchimp;

use Champ\Championship\Championship;
use Champ\Newsletters\CampaignMaker as CampaignMakerInterface;
use Mailchimp;

class CampaignMaker implements CampaignMakerInterface
{
    /**
     * Mailchimp
     *
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * Inject Constructor
     *
     * @param Mailchimp $mailchimp
     */
    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Compose a campaign for a championship mail
     *
     * @param  Championship $championship
     * @param  string       $subject
     * @param  string       $content
     * @return int                     id of campaign
     */
    public function composeForChampionship(Championship $championship, $subject, $content)
    {
        $response = $this->mailchimp->campaigns->create('regular', [
            'list_id' => getenv('CHAMPIONSHIPS_SUBSCRIBERS_LIST'),
            'subject' => 'Recado do Organizador para você', // default message
            'from_email' => 'correio@battleroad.com.br', // default from email
            'from_name' => 'Correio Battleroad', // default from name
            'template_id' => getenv('CHAMPIONSHIPS_CAMPAIGN_TEMPLATE') // default template for this campaigns
        ], [
            'sections' => [
                'championship_name' => $championship->name,
                'organizer_subject' => $subject,
                'organizer_content' => $this->decorateContent($content),
                'organizer_name' => $championship->user->name
            ]
        ], ['saved_segment_id' => $championship->segment, 'match' => 'all']);

        return $response['id'];
    }

    /**
     * Send a campaign
     *
     * @param  int $campaignId
     * @return mixed
     */
    public function send($campaignId)
    {
        return $this->mailchimp->campaigns->send($campaignId);
    }

    /**
     * Summary if a specific campaign
     *
     * @param  int $campaignId
     * @return mixed
     */
    public function summary($campaignId)
    {
        return $this->mailchimp->reports->summary($campaignId);
    }

    /**
     * Decorate the content
     * This functions does nothing now, but in the future I want to
     * parse markdown, so the user will may use to better e-mails
     *
     * @param  string $content
     * @return string
     */
    private function decorateContent($content)
    {
        return nl2br($content);
    }
}
