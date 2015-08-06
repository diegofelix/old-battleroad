<?php

namespace Champ\Newsletters;

interface ChampionshipSegment {

    /**
     * Create a new segment
     *
     * @param  string $segmentName
     * @return mixed
     */
    public function createSegment($segmentName);

    /**
     * Subscribe a email to a segment
     *
     * @param  int $segmentId
     * @param  string $email
     * @return mixed
     */
    public function subscribeTo($segmentId, $email);

    /**
     * Unsubscribe a user from a segment
     *
     * @param  int $segmentId
     * @param  string $email
     * @return mixed
     */
    public function unsubscribeFrom($segmentId, $email);

}