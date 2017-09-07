<?php

namespace Champ\Contexts\Core;

use Illuminate\Database\Eloquent\Model;

interface ContextInterface
{
    /**
     * Set the context.
     *
     * @param Illuminate\Database\Eloquent\Model
     */
    public function set(Model $scope);

    /**
     * Check to see if the context has been set.
     *
     * @return bool
     */
    public function has();

    /**
     * Get the context identifier.
     *
     * @return int
     */
    public function id();
}
