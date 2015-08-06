<?php

namespace Champ\Newsletters\Mailchimp;

use Champ\Newsletters\ChampionshipSegment as ChampionshipSegmentInterface;
use Mailchimp;

class ChampionshipSegment implements ChampionshipSegmentInterface
{
    /**
     * List Id
     *
     * @var int
     */
    protected $listId;

    /**
     * Mailchimp
     *
     * @var Mailchimp
     */
    protected $mailchimp;

    public function __construct(Mailchimp $mailchimp)
    {
        $this->mailchimp = $mailchimp;
        $this->listId = getenv('CHAMPIONSHIPS_SUBSCRIBERS_LIST');
    }

    /**
     * Create a new segment
     *
     * @param  string $segmentName
     * @return mixed
     */
    public function createSegment($segmentName)
    {
        $response = $this->mailchimp->lists->staticSegmentAdd($this->listId, $segmentName);

        return $response['id'];
    }

    /**
     * Subscribe a email to a segment
     *
     * @param  int $segmentId
     * @param  string $email
     * @return mixed
     */
    public function subscribeTo($segmentId, $email)
    {
        $emails[] = compact('email');

        $response = $this->mailchimp->lists->staticSegmentMembersAdd($this->listId, $segmentId, $emails);

        if ($response['success_count'] == 1) return true;

        return false;
    }

    /**
     * Unsubscribe a user from a segment
     *
     * @param  int $segmentId
     * @param  string $email
     * @return mixed
     */
    public function unsubscribeFrom($segmentId, $email)
    {
        $emails[] = compact('email');

        $response = $this->mailchimp->lists->staticSegmentMembersDel($this->listId, $segmentId, $emails);

        if ($response['success_count'] == 1) return true;

        return false;
    }
}
