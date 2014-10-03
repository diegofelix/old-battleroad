<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Championship;
use Champ\Validators\ChampionshipValidator;
use Champ\Contexts\Core\ContextInterface;
use Champ\Championship\Competition;
use App;
use Auth;
use Config;

class ChampionshipRepository extends AbstractRepository implements ChampionshipRepositoryInterface {

    public function __construct(
        Championship $model,
        ChampionshipValidator $validator
    )
    {
        $this->model = $model;
        $this->validator = $validator;
    }

    /**
     * Get a list of Championships in event_start desc order
     *
     * @return Paginator
     */
    public function featured($game = null)
    {
        $query = $this->model->wherePublished(true);

        if ($game)
        {
            $query->whereHas('competitions', function($q) use ($game)
            {
                $q->whereHas('game', function($g) use ($game)
                {
                    $g->where('name', '=', $game);
                });
            });
        }

        return $query->orderBy('event_start', 'desc')->paginate();
    }

    /**
     * Publish a championship
     *
     * @param  int $id
     * @return bool
     */
    public function publish($id)
    {
        $championship = $this->model->find($id);

        $championship->published = true;

        return $championship->save();
    }

    /**
     * Save the location and price for the championship
     *
     * @param  array $input
     * @return mixed
     */
    public function saveLocation($input)
    {
        $championship = $this->model->findOrFail($input['id']);

        // prevent malicious intentions checking the ownership
        if ($championship->user_id != Auth::user()->id) return false;

        if ( ! $this->validator->passes($input, 'location'))
        {
            $this->errors = $this->validator->errors();
            return false;
        }

        // save only the inputs specifieds in the form.
        $championship->location         = $input['location'];
        $championship->price            = $this->updatePrice($input['price']);
        $championship->original_price   = $input['price'];
        $championship->limit            = $input['limit'];

        return $championship->save();
    }

    /**
     * Return a competition by a champ id
     *
     * @param  int $champId
     * @param  int $competitionId
     * @return Model
     */
    public function getCompetition($champId, $competitionId)
    {
        $championship = $this->model->find($champId);

        return $championship->competitions()->find($competitionId);
    }

    public function getAvailableCompetitions()
    {
        $competitions = [];
        $championships = $this->model->with('competitions.game')->where('published', 1)->get();

        foreach($championships as $champ)
        {
            foreach ($champ->competitions as $competition)
            {
                $competitions[] = $competition->game->name;
            }
        }

        return array_unique($competitions);
    }

    /**
     * Create a new competition and attach to the championship
     *
     * @param  int $champId
     * @param  array $data
     * @return mixed
     */
    public function createCompetition($champId, $data)
    {
        // get the championship
        $championship = $this->find($champId, ['competitions']);

        // check if validation passes
        if ( ! $this->validator->passes($data, 'competition'))
        {
            $this->errors = $this->validator->errors();
            return false;
        }

        // set the limit for the competition
        $data['limit'] = $this->updateLimitValues($championship, $data);

        // updates the price.
        $data['price']          = $this->updatePrice($data['price']);
        $data['original_price'] = $data['price'];

        // create a new Competition
        $competition = new Competition($data);

        // attach the competition to the championship
        return $championship->competitions()->save($competition);
    }

    /**
     * Save a championship
     *
     * @param  Championship $championship
     * @return mixed
     */
    public function save(Championship $championship)
    {
        return $championship->save();
    }

    /**
     * Create a championship assigned to a user
     *
     * @param  int $userId
     * @param  array  $data
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
     * Get all championships for the user
     *
     * @param  int $id
     * @param  array $with
     * @return Collectino
     */
    public function getAllByUser($id, $with)
    {
        return $this->model
            ->whereUserId($id)
            ->wherePublished(true)
            ->get();
    }

    /**
     * Upload an image
     *
     * @param  array $data
     * @return string url to the image uploaded
     */
    private function uploadImage($data)
    {
        // if was not image, go away
        if ( ! $data['image']) return null;

        $champImage = App::make('Champ\Services\ChampionshipImage');

        return $champImage->upload($data['image']);
    }

    /**
     * Check if the limit of players in competition is greater than the championship limit
     * if so, then, we will limit the numbers os players to the max limit of the championship
     *
     * @param  Championship $championship
     * @param  array $data
     * @return mixed
     */
    private function updateLimitValues($championship, $data)
    {
        // if no limit was specified, then is the same as the championship limit
        if (empty($data['limit'])) return $championship->limit;

        // if the championship dont have limit we dont need to
        // check this
        if (empty($championship->limit)) return $data['limit'];

        // if the limit for the competition is greater than the championship
        // we limit to the championship limit
        if ($data['limit'] > $championship->limit) return $championship->limit;

        // if came here, then return himself.
        return $data['limit'];
    }

    /**
     * Apply our rate to the price
     *
     * @param  int $price
     * @return float
     */
    public function updatePrice($price)
    {
        return apply_rate($price, Config::get('champ.rate'));
    }

    /**
     * Add a refresh token, used by the billing mercado pago for the user
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

}