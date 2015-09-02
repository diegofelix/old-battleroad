<?php
namespace Champ\Services;

use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Join\Item;
use Champ\Join\Join;
use Champ\Join\Nick;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
use Champ\Join\Status;
use Champ\Join\UserAlreadyJoinedException;
use DB;

/**
* Join User Service
*/
class JoinUserService
{
    protected $user;
    protected $joins;
    protected $competitions;
    protected $items;
    protected $players;

    function __construct(
        JoinRepositoryInterface $joins,
        CompetitionRepositoryInterface $competitions,
        ItemRepositoryInterface $items
    ) {
        $this->joins = $joins;
        $this->competitions = $competitions;
        $this->items = $items;
    }

    /**
     * Register all the join process
     *
     * @param  User $user
     * @param  Championship $championship
     * @param  array $competitions
     * @param  array $nicks
     * @param  string $teamName
     * @return Join
     */
    public function register($user, $championship, $competitions, $nicks, $teamName = null)
    {
        // save the join
        $join = $this->saveJoin($user, $championship, $nicks);

        // save the competition for theses joins ( its saved as items )
        $items = $this->saveCompetitionsForJoin($join, $competitions, $teamName);

        // for each item we save a list of nicks
        $this->saveNicksForItems($items, $nicks);

        // check to see if a join is paid or not and update it status
        $this->updateJoinStatusIfItsFree($join);

        return $join;
    }

    /**
     * Update the Join Status if the Join is Free
     *
     * @param  Join $join
     * @return void
     */
    public function updateJoinStatusIfItsFree($join)
    {
        if ($join->isFree()) {
            $join->status_id = Status::APPROVED;
            $join->save();
        }
    }

    /**
     * Save nicks for each item
     *
     * @param  array $items
     * @param  array $nicks
     * @return void
     */
    private function saveNicksForItems($items, $nicks)
    {
        foreach ($items as $item) {
            if (array_key_exists($item->competition_id, $nicks)) {
                $this->saveNicksForItem($item, $nicks);
            }
        }
    }

    /**
     * Save competitions for this join
     *
     * @param  Join $join
     * @param  array $competitions
     * @return array
     */
    private function saveCompetitionsForJoin($join, $competitions, $teamName = null)
    {
        $foundCompetitions = $this->competitions->getByIds($competitions);

        foreach ($foundCompetitions as $competition) {

            $isTeamCompetition = !$competition->present()->isSingleRegistration();

            $teamName = ($isTeamCompetition) ? $teamName : '';

            $items[] = Item::register($competition->id, $competition->price, $teamName);
        }

        $join->items()->saveMany($items);

        return $items;
    }

    /**
     * Save the join
     *
     * @param  User $user
     * @param  Championship $championship
     * @return Join
     */
    private function saveJoin($user, $championship, $nicks)
    {
        if ($this->joins->userParticipating($user->id, $championship->id)) {
            throw new UserAlreadyJoinedException("Esse e-mail já está participando deste campeonato.");
        }

        // first nick he encounter
        $nick  = reset($nicks)[0];
        if (! $nick) {
            $nick = $user->name;
        }

        $join = Join::register($user->id, $championship->id, $nick);

        $this->joins->save($join);

        return $join;
    }

    /**
     * Save nicks for a single item
     *
     * @param  Item $item
     * @param  array $nicks
     * @return void
     */
    private function saveNicksForItem($item, $nicks)
    {
        $savedNicks = [];

        foreach ($nicks[$item->competition_id] as $nick) {
            $savedNicks[] = Nick::register($nick);
        }

        $item->nicks()->saveMany($savedNicks);
    }
}