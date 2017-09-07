<?php

namespace Champ\Services;

class KeyGen
{
    protected $hash = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ01234567890';

    /**
     * Generate a hash with strings separated by a -.
     *
     * @param int $limit
     * @param int $chunkSize
     *
     * @return string
     */
    public function make($limit = 11, $chunkSize = 3)
    {
        return substr(chunk_split(str_shuffle($this->hash), $chunkSize, '-'), 0, $limit);
    }
}
