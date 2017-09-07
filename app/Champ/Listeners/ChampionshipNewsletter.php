<?php

namespace Champ\Listeners;

use Champ\Championship\Events\ChampionshipPublished;
use Champ\Championship\Repositories\ChampionshipRepository;
use Champ\Join\Events\UserJoined;
use Champ\Newsletters\ChampionshipSegment;
use Illuminate\Support\Str;
use Laracasts\Commander\Events\EventListener;

class ChampionshipNewsletter extends EventListener
{
    /**
     * Championship Newsletter List.
     *
     * @var ChampionshipSegment
     */
    protected $newsletter;

    /**
     * Championship Repository.
     *
     * @var Champ\Championship\Repositories\ChampionshipRepository
     */
    protected $championships;

    /**
     * Constructor.
     *
     * @param ChampionshipSegment $newsletter
     */
    public function __construct(
        ChampionshipSegment $newsletter,
        ChampionshipRepository $championships
    ) {
        $this->newsletter = $newsletter;
        $this->championships = $championships;
    }

    /**
     * Create a segment in the newsletter list when championship is published.
     *
     * @param ChampionshipPublished $championship
     *
     * @return bool
     */
    public function whenChampionshipPublished(ChampionshipPublished $championship)
    {
        $championship = $championship->championship;

        $segment = $this->newsletter->createSegment($this->createSegmentName($championship));

        $championship->segment = $segment;

        return $this->championships->save($championship);
    }

    /**
     * Add a user to the segment.
     *
     * @param UserJoined $event
     */
    public function whenUserJoined(UserJoined $event)
    {
        $championship = $event->join->championship;
        $email = $event->join->user->email;

        // only if a championship has a segment in the list
        if (!is_null($championship->segment)) {
            $this->newsletter->subscribeTo($championship->segment, $email);
        }
    }

    /**
     * Generate a new name for a segment based on the championship name and attributes.
     *
     * @param Championsip $championship
     *
     * @return string
     */
    private function createSegmentName($championship)
    {
        return $championship->id.'-'.Str::slug($championship->name);
    }
}
