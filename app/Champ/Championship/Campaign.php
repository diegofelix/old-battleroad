<?php

namespace Champ\Championship;

use Champ\Championship\Events\CampaignWasCreated;
use Eloquent;
use Laracasts\Commander\Events\EventGenerator;

class Campaign extends Eloquent
{
    protected $fillable = ['championship_id', 'subject', 'body', 'campaign_id'];

    use EventGenerator;

    /**
     * Relation with Championship
     *
     * @return BelongsTo
     */
    public function championship()
    {
        return $this->belongsTo('Champ\Championship\Championship');
    }

    /**
     * Compose a new campaign
     *
     * @param  int $championship_id
     * @param  string $subject
     * @param  string $body
     * @param  string $campaign_id
     * @return Model
     */
    public function compose($championship_id, $subject, $body, $campaign_id)
    {
        $this->championship_id = $championship_id;
        $this->subject = $subject;
        $this->body = $body;
        $this->campaign_id = $campaign_id;

        $this->raise(new CampaignWasCreated($this));
    }
}
