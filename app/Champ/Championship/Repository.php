<?php

namespace Champ\Championship;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Services\ChampionshipImage;
use Champ\Validators\ChampionshipValidator;
use Laracasts\Commander\Events\DispatchableTrait;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use Log;

/**
 * Responsible for handling all championships interactions.
 */
class Repository extends AbstractRepository
{
    use DispatchableTrait;

    /**
     * Class constructor.
     *
     * @param Championship          $model
     * @param ChampionshipValidator $validator
     */
    public function __construct(
        Championship $model,
        ChampionshipValidator $validator
    ) {
        parent::__construct($model);
        $this->validator = $validator;
    }

    /**
     * Find a championship if its available.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function findAvailable($id)
    {
        return $this->model->whereId($id)
            ->wherePublished(true)
            ->whereFinished(false)
            ->first();
    }

    /**
     * Get a list of Championships in event_start desc order.
     *
     * @return \Illuminate\Contracts\Pagination\Paginator
     */
    public function featured($game = null)
    {
        $query = $this->model->wherePublished(true)
            ->whereFinished(false);

        if ($game) {
            $query = $this->getChampionshipsWithGames($query, $game);
        }

        return $query->orderBy('event_start')->paginate();
    }

    /**
     * Publish a championship.
     *
     * @param int $id
     *
     * @return bool
     */
    public function publish($id)
    {
        $championship = $this->model->find($id);

        $championship->publish();

        $championship->save();

        return $championship;
    }

    /**
     * Save the location and price for the championship.
     *
     * @param array $input
     *
     * @return mixed
     */
    public function saveLocation($input)
    {
        $championship = $this->model->findOrFail($input['id']);

        // prevent malicious intentions checking the ownership
        if ($championship->user_id != auth()->user()->id) {
            return false;
        }

        if (!$this->validator->passes($input, 'location')) {
            $this->errors = $this->validator->errors();

            return false;
        }

        // save only the inputs specifieds in the form.
        $championship->location = $input['location'];
        $championship->price = $this->updatePrice($input['price']);
        $championship->original_price = $input['price'];
        $championship->limit = $input['limit'];

        return $championship->save();
    }

    /**
     * Returns a competition by a champ id.
     *
     * @param int $champId
     * @param int $competitionId
     *
     * @return Model
     */
    public function getCompetition($champId, $competitionId)
    {
        $championship = $this->model->find($champId);

        return $championship->competitions()->find($competitionId);
    }

    /**
     * Returns a list of available competitions.
     *
     * @return array
     */
    public function getAvailableCompetitions()
    {
        $competitions = [];
        $championships = $this->model->with('competitions.game')
            ->wherePublished(true)
            ->whereFinished(false)
            ->get();

        foreach ($championships as $champ) {
            foreach ($champ->competitions as $competition) {
                $competitions[] = $competition->game->name;
            }
        }

        return array_unique($competitions);
    }

    /**
     * Create a new competition and attach to the championship.
     *
     * @param int   $champId
     * @param array $data
     *
     * @return mixed
     */
    public function createCompetition($champId, $data)
    {
        // get the championship
        $championship = $this->find($champId, ['competitions']);

        // check if validation passes
        if (!$this->validator->passes($data, 'competition')) {
            $this->errors = $this->validator->errors();

            return false;
        }

        if (!$this->competitionStartsAfterChampionship($championship, $data['start'])) {
            $this->errors = new Collection(['O Campo data deve ter uma data maior que o campeonato.']);

            return false;
        }

        // set the limit for the competition
        $data['limit'] = $this->updateLimitValues($data);

        // updates the price.
        $data['original_price'] = $data['price'];
        $data['price'] = $this->updatePrice($data['price']);

        // create a new Competition
        $competition = new Competition($data);

        // attach the competition to the championship
        return $championship->competitions()->save($competition);
    }

    /**
     * Save a championship.
     *
     * @param Championship $championship
     *
     * @return mixed
     */
    public function save(Championship $championship)
    {
        return $championship->save();
    }

    /**
     * Create a championship assigned to a user.
     *
     * @param int   $userId
     * @param array $data
     *
     * @return Model
     */
    public function create(array $data)
    {
        // do the upload
        $image = $this->uploadImage($data);

        // save the images
        $data['image'] = $image->getImagePath();
        $data['thumb'] = $image->getThumbPath();

        // continue to save the championship
        return parent::create($data);
    }

    /**
     * Get all championships for the user.
     *
     * @param int   $id
     * @param array $with
     *
     * @return Collection
     */
    public function getAllByUser($id, $with = [])
    {
        return $this->model->with($with)
            ->whereUserId($id)
            ->wherePublished(true)
            ->get();
    }

    private function competitionStartsAfterChampionship($championship, $eventStart)
    {
        $date = Carbon::createFromFormat('d/m/Y H:i', $eventStart)->toDateTimeString();

        return $date >= $championship->event_start;
    }

    /**
     * Upload an image.
     *
     * @param array $data
     *
     * @return string url to the image uploaded
     */
    private function uploadImage($data)
    {
        // if was not image, go away
        if (!$data['image']) {
            return null;
        }

        return app(ChampionshipImage::class)
            ->upload($data['image']);
    }

    /**
     * Check if the limit of players in competition is greater than the championship limit
     * if so, then, we will limit the numbers os players to the max limit of the championship.
     *
     * @param Championship $championship
     * @param array        $data
     *
     * @return mixed
     */
    private function updateLimitValues($data)
    {
        if (empty($data['limit'])) {
            return 99999;
        }

        return $data['limit'];
    }

    /**
     * Apply our rate to the price.
     *
     * @param int $price
     *
     * @return float
     */
    public function updatePrice($price)
    {
        return apply_rate($price, config('champ.rate'));
    }

    /**
     * Add a refresh token, used by the billing mercado pago for the user.
     *
     * @param string $refreshToken
     */
    public function addRefreshToken($id, $refreshToken)
    {
        $championship = $this->model->find($id);
        $championship->refresh_token = $refreshToken;
        $championship->save();

        return $championship;
    }

    /**
     * Cancel past championships based on the current date.
     */
    public function finishPastChampionships()
    {
        $limit = config('champ.payday_limit');

        // get all championships that cross the limit of time
        $championships = $this->getNotFinishedByDateDiff($limit);

        // pass for all these championships and "finish him!"
        foreach ($championships as $championship) {
            $championship->finishChampionship();
            $this->dispatchEventsFor($championship);
            Log::info('championship '.$championship->id.' finished.');
        }
    }

    /**
     * Get a waiting list for the championship.
     *
     * @param Championship $championship
     *
     * @return Collection
     */
    public function waitingList(Championship $championship)
    {
        return $championship->waitingList()
                            ->groupBy('user_id')
                            ->orderBy('id')
                            ->get();
    }

    /**
     * Get all users that not paid yet.
     *
     * @return Collection
     */
    public function getUsersFromCommingChampionships($dayLimit = 3)
    {
        $championships = $this->getNotFinishedByDateDiff($dayLimit, ['joins.user']);

        $toSendAlert = [];

        foreach ($championships as $championship) {
            foreach ($championship->joins as $join) {
                if (!$join->wasPaid()) {
                    $toSendAlert[] = $join;
                }
            }
        }

        return $toSendAlert;
    }

    /**
     * Get all championships by the limit passed.
     *
     * @param int   $limit
     * @param array $with
     *
     * @return Collection
     */
    public function getNotFinishedByDateDiff($limit = 2, $with = [])
    {
        return $this->model->with($with)
            ->whereFinished(false)
            ->whereRaw('datediff(event_start, now()) = ?', [$limit])
            ->get();
    }

    /**
     * Return a relation query with game.
     *
     * @param QueryBuilder $query
     * @param string       $game
     *
     * @return QueryBuilder
     */
    private function getChampionshipsWithGames($query, $game)
    {
        return $query->whereHas('competitions', function ($q) use ($game) {
            $q->whereHas('game', function ($g) use ($game) {
                $g->where('name', '=', $game);
            });
        });
    }

    /**
     * Get all competitions by an array of ids.
     *
     * @param array $ids
     *
     * @return Collection
     */
    public function getCompetitionsByIds(array $ids)
    {
        return Competition::whereIn('id', $ids)->get();
    }

    /**
     * Saves a competition.
     *
     * @param Competition $competition
     *
     * @return bool
     */
    public function saveCompetition(Competition $competition)
    {
        return $competition->save();
    }

    /**
     * Get competitions by the championship id.
     *
     * @param id    $championshipId
     * @param array $with
     *
     * @return Collection
     */
    public function getCompetitionsByChampionship($championshipId, $with = [])
    {
        return Competition::with($with)
            ->whereChampionshipId($championshipId)
            ->get();
    }

    /**
     * Saves a Coupon.
     *
     * @param Coupon $coupon
     *
     * @return bool
     */
    public function saveCoupon(Coupon $coupon)
    {
        return $coupon->save();
    }

    /**
     * Creates a coupon an assign it to a championship.
     *
     * @param array $data
     *
     * @return Model
     */
    public function createCoupon($data)
    {
        return Competition::create($data);
    }

    /**
     * Find a coupon by its id.
     *
     * @param int $id
     *
     * @return Model
     */
    public function findCoupon($id)
    {
        return Competition::find($id);
    }

    /**
     * Delete a Coupon.
     *
     * @param Coupon $coupon
     *
     * @return bool
     */
    public function deleteCoupon(Coupon $coupon)
    {
        return $coupon->delete();
    }

    /**
     * Get a coupon by its code and checks if the coupon is able to be used.
     *
     * @param string $code
     *
     * @return Coupon
     */
    public function findCouponByCode($code)
    {
        return Competition::whereCode($code)
            ->whereNull('user_id')
            ->first();
    }

    /**
     * Find a Coupon by User Id.
     *
     * @param int $userId
     *
     * @return Coupon
     */
    public function findCouponByUserId($userId)
    {
        return Competition::whereUserId($userId)->first();
    }

    /**
     * Get a list of Formats.
     *
     * @return array
     */
    public function getFormatsDropdown()
    {
        return Format::lists('name', 'id');
    }

    /**
     * Get a list of games.
     *
     * @return array
     */
    public function getGamesDropdown()
    {
        return Game::lists('name', 'id');
    }

    /**
     * Get a list of Platforms.
     *
     * @return array
     */
    public function getPlatformsDropdown()
    {
        return Platform::lists('name', 'id');
    }
}
