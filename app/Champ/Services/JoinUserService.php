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

    public function register($user, $championship, $competitions, $nicks)
    {
        // save the join
        $join = Join::register($user->id, $championship->id);
        $this->joins->save($join);

        // get the competitions
        $foundCompetitions = $this->competitions->getByIds($competitions);

        // for each competition found we insert a new item
        foreach ($foundCompetitions as $competition)
        {
            $items[] = Item::register($competition->id, $competition->price);
            // $item->join()->associate($join);
            // $join->items()->associate($item);
        }
        $join->items()->saveMany($items);

        foreach ($items as $item)
        {
            if (array_key_exists($item->competition_id, $nicks))
            {
                $savedNicks = [];
                foreach ($nicks[$item->competition_id] as $nick)
                {
                    $savedNicks[] = Nick::register($nick);
                }
                $item->nicks()->saveMany($savedNicks);
                $savedNicks = [];
            }
        }

        return $join;
    }
}