<?php namespace Champ\State;

use Eloquent;

class State extends Eloquent {

    /**
     * Table for the model
     */
    protected $table = 'states';

    /**
     * All fields can be mass assigned
     */
    protected $guarded = [];

}