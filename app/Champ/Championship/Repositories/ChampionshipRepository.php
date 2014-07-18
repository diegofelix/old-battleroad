<?php namespace Champ\Championship\Repositories;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Championship;
use Champ\Validators\ChampionshipValidator;
use Champ\Contexts\Core\ContextInterface;
use Champ\Championship\Competition;
use App;
use Auth;

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
    public function featured()
    {
        return $this->model->with('user')
            ->wherePublished(true)
            ->orderBy('event_start', 'desc')
            ->paginate();
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

        $championship->published = 1;

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
        $championship->location = $input['location'];
        $championship->price    = $input['price'];
        $championship->limit    = $input['limit'];

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

        // set the limit to the championship limit if value is greater than
        if (isset($data['limit']) && $data['limit'] > $championship->limit)
        {
            $data['limit'] = $championship->limit;
        }

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
    public function register(Championship $championship)
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
        if (isset($championship->limit) && isset($data['limit']))
        {
            if ($data['limit'] > $championship->limit)
            {
                return $championship->limit;
            }

            return $data['limit'];
        }

        return null;
    }

}