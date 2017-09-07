<?php

namespace Champ\Contexts;

use Illuminate\Database\Eloquent\Model;
use Champ\Contexts\Core\ContextInterface;

class UserContext implements ContextInterface
{
    /**
     * Context.
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $context;

    /**
     * Set the context.
     *
     * @param Illuminati\Database\Eloquent\Model $context
     */
    public function set(Model $context)
    {
        $this->context = $context;
    }

    /**
     * Check if the context has been set.
     *
     * @return bool
     */
    public function has()
    {
        return isset($this->context);
    }

    /**
     * Get the context identifier.
     *
     * @return int
     */
    public function id()
    {
        return $this->context->id;
    }
}
