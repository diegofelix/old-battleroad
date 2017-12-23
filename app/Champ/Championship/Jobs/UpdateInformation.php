<?php

namespace Champ\Championship\Jobs;

use Battleroad\Jobs\Job;
use Champ\Championship\Repository;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Queue\SerializesModels;

class UpdateInformation extends Job implements SelfHandling
{
    use SerializesModels;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $stream;

    /**
     * @param int    $id
     * @param string $name
     * @param string $description
     * @param string $stream
     */
    public function __construct($id, $name, $description, $stream = '')
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->stream = $stream;
    }

    /**
     * {@inheritdoc}
     */
    public function handle(Repository $repository)
    {
        $championship = $repository->find($this->id);

        $championship->updateInformation($this->name, $this->description, $this->stream);

        $repository->save($championship);

        return $championship;
    }
}
