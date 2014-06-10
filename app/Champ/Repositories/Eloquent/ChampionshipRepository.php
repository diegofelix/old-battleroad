<?php namespace Champ\Repositories\Eloquent;

use Champ\Repositories\Core\AbstractRepository;
use Champ\Championship\Championship;
use Champ\Validators\ChampionshipValidator;
use Champ\Repositories\ChampionshipRepositoryInterface;
use Champ\Contexts\Core\ContextInterface;
use App;

class ChampionshipRepository extends AbstractRepository implements ChampionshipRepositoryInterface {

    protected $context;

    public function __construct(
        Championship $model,
        ChampionshipValidator $validator,
        ContextInterface $context
    )
    {
        $this->model = $model;
        $this->validator = $validator;
        $this->context = $context;
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
        $user = $this->model->find($id);

        $user->published = 1;

        return $user->save();
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
     * Upload a file
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