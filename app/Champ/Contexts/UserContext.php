<?php namespace Champ\Contexts;

use Illuminate\Database\Eloquent\Model;
use Champ\Contexts\Core\ContextInterface;

class UserContext implements ContextInterface{

    /**
     * Context
     *
     * @var Illuminate\Database\Eloquent\Model
     */
    protected $context;

    /**
     * Set the context
     * @param Illuminati\Database\Eloquent\Model $context
     */
    public function set(Model $context)
    {
        $this->context = $context;
    }

    /**
     * Check if the context has been set
     *
     * @return boolean
     */
    public function has()
    {
        if($this->context) return true;
        return false;
    }

    /**
     * Get the context identifier
     *
     * @return integer
     */
    public function id()
    {
        return $this->context->id;
    }
}