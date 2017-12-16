<?php

namespace Champ\Services;

use Champ\Account\User;
use Champ\Championship\Championship;
use Champ\Championship\Repository;
use Champ\Join\Events\UserJoined;
use Champ\Join\Item;
use Champ\Join\Join;
use Champ\Join\Nick;
use Champ\Join\Repositories\ItemRepository;
use Champ\Join\Repositories\JoinRepository;
use Champ\Join\Status;
use Champ\Join\UserAlreadyJoinedException;

/**
 * Join User Service.
 */
class JoinUserService
{
    /**
     * @var JoinRepository
     */
    protected $joinRepository;

    /**
     * Championship Repository.
     *
     * @var Repository
     */
    protected $repository;

    /**
     * Class constructor.
     *
     * @param JoinRepository $joinRepository
     * @param Repository     $repository
     * @param ItemRepository $itemRepository
     */
    public function __construct(
        JoinRepository $joinRepository,
        Repository $repository,
        ItemRepository $itemRepository
    ) {
        $this->joinRepository = $joinRepository;
        $this->repository = $repository;
        $this->itemRepository = $itemRepository;
    }

    /**
     * Register all the join process.
     *
     * @param User         $user
     * @param Championship $championship
     * @param array        $competitions
     * @param array        $nicks
     * @param string       $teamName
     *
     * @return Join
     *
     * @throws UserAlreadyJoinedException
     */
    public function register(
        User $user,
        Championship $championship,
        $competitions,
        $nicks,
        $teamName = null
    ) {
        // save the join
        $join = $this->saveJoin($user, $championship, $nicks);

        // save the competition for theses joins ( its saved as items )
        $items = $this->saveCompetitionsForJoin($join, $competitions, $teamName);

        // for each item we save a list of nicks
        $this->saveNicksForItems($items, $nicks);

        // check to see if a join is paid or not and update it status
        $this->updateJoinStatusIfItsFree($join);

        event(new UserJoined($join));

        return $join;
    }

    /**
     * @var ItemRepository
     */
    protected $itemRepository;

    /**
     * Update the Join Status if the Join is Free.
     *
     * @param Join $join
     */
    public function updateJoinStatusIfItsFree($join)
    {
        if ($join->isFree()) {
            $join->status_id = Status::APPROVED;
            $join->save();
        }
    }

    /**
     * Save nicks for each item.
     *
     * @param array $items
     * @param array $nicks
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
     * Save competitions for this join.
     *
     * @param Join        $join
     * @param array       $competitions
     * @param string|null $teamName
     *
     * @return array
     */
    private function saveCompetitionsForJoin($join, $competitions, $teamName = null)
    {
        $foundCompetitions = $this->repository->getCompetitionsByIds($competitions);

        foreach ($foundCompetitions as $competition) {
            $isTeamCompetition = !$competition->present()->isSingleRegistration();

            $teamName = ($isTeamCompetition) ? $teamName : '';

            $items[] = Item::register($competition->id, $competition->price, $teamName);
        }

        $join->items()->saveMany($items);

        return $items;
    }

    /**
     * Save the join.
     *
     * @param User         $user
     * @param Championship $championship
     * @param              $nicks
     *
     * @return Join
     *
     * @throws UserAlreadyJoinedException
     */
    private function saveJoin(User $user, Championship $championship, $nicks)
    {
        if ($this->joinRepository->userParticipating($user->id, $championship->id)) {
            throw new UserAlreadyJoinedException('Esse e-mail já está participando deste campeonato.');
        }

        // first nick he encounter
        $nick = reset($nicks)[0];
        if (!$nick) {
            $nick = $user->name;
        }

        $join = Join::register($user->id, $championship->id, $nick);

        $this->joinRepository->save($join);

        return $join;
    }

    /**
     * Save nicks for a single item.
     *
     * @param Item  $item
     * @param array $nicks
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
