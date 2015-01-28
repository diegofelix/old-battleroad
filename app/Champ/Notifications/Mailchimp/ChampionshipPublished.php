<?php namespace Champ\Notifications\Mailchimp;

use Champ\Notifications\ChampionshipPublished as ChampionshipPublishedInterface;
use Mailchimp;

class ChampionshipPublished implements ChampionshipPublishedInterface {

    /**
     * List id
     */
    const CHAMPIONSHIP_SUBSCRIBERS_ID = '425ef84f09';

    /**
     * List of templates
     *
     * @var array
     */
    protected $templates = [
        'defaultTemplate' => '115533'
    ];

    /**
     * Mailchimp
     *
     * @var Mailchimp
     */
    protected $mailchimp;

    /**
     * @param Mailchimp $mailchimp
     */
    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
    }

    /**
     * Notify a user when a championship is published
     *
     * @param  string $title
     * @param  string $body
     * @return mixed
     */
    public function notify($title, $body)
    {
        $options = [
            'list_id' => self::CHAMPIONSHIP_SUBSCRIBERS_ID,
            'subject' => 'Correio Battleroad: Novo Campeonato',
            'from_name' => 'Battleroad',
            'from_email' => 'contato@battleroad.com.br',
            'to_name' => 'Battleroad Subscriber',
            'template_id' => $this->templates['defaultTemplate']
        ];

        $content = [
            'html' => $body,
            'text' => strip_tags($body)
        ];

        $campaign = $this->mailchimp->campaigns->create('regular', $options, $content);

        $this->mailchimp->campaigns->send($campaign['id']);
    }

}