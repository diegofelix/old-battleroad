<?php namespace Champ\Repositories\Eloquent;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Championship;
use Champ\Validators\ChampionshipValidator;
use Champ\Repositories\ChampionshipRepositoryInterface;
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
        $championship->price = $input['price'];

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
        return $this->model->with(['competitions' => function($query) use ($competitionId)
        {
            $query->where('id', '=', $competitionId);
        }])
        ->find($champId);
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

        // create a new Competition
        $competition = new Competition($data);

        // attach the competition to the championship
        return $championship->competitions()->save($competition);
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

}