<?php
namespace Champ\Services;

use Champ\Championship\Repositories\CompetitionRepositoryInterface;
use Champ\Join\Item;
use Champ\Join\Join;
use Champ\Join\Nick;
use Champ\Join\Repositories\ItemRepositoryInterface;
use Champ\Join\Repositories\JoinRepositoryInterface;
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
        $join = $this->saveJoin($user, $championship);


        // save the competition for theses joins ( its saved as items )
        $items = $this->saveCompetitionsForJoin($join, $competitions, $teamName);

        // for each item we save a list of nicks
        $this->saveNicksForItems($items, $nicks);

        return $join;
    }

    /**
     * Save nicks for each item
     *
     * @param  array $items
     * @param  array $nicks
     * @return void
     */
    public function saveNicksForItems($items, $nicks)
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
    private function saveJoin($user, $championship)
    {
        $join = Join::register($user->id, $championship->id);
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