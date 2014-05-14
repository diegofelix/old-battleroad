<?php namespace Champ\Repositories\Eloquent;

use Champ\Repositories\Core\TenantRepository;
use Champ\Championship\Championship;
use Champ\Validators\ChampionshipValidator;
use Champ\Repositories\ChampionshipRepositoryInterface;
use Champ\Contexts\Core\ContextInterface;

class ChampionshipRepository extends TenantRepository implements ChampionshipRepositoryInterface {

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
        $data['image'] = $this->uploadImage($data);

        return parent::create($data);
    }

    /**
     * Upload a file
     *
     * @param  array $data
     * @return string url to the image uploaded
     */
    public function uploadImage($data)
    {
        // if was not image, go away
        if ( ! $data['image']) return null;

        $imagePath = '/images/championships/';
        $imageName = $data['user_id'] . '_' . time() . '.jpg';

        $data['image']->move(public_path() . $imagePath, $imageName);

        return $imagePath . $imageName;
    }

}