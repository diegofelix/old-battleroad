<?php namespace Champ\Championship;

use Champ\Core\Repository\AbstractRepository;

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
        return $this->make(['user'])
            ->wherePublished(true)
            ->orderBy('event_start', 'desc')
            ->paginate();
    }

    /**
     * Create a championship assigned to a user
     *
     * @param  int $userId
     * @param  array  $data
     * @return Model
     */
    public function createForUser($userId, $data)
    {
        $data['user_id'] = $userId;
        $data['image'] = $this->uploadImage($data);

        return $this->create($data);
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