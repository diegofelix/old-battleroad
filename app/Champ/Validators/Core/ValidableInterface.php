<?php

namespace Champ\Validators\Core;

interface ValidableInterface
{
    /**
     * Passes.
     *
     * @return bool
     */
    public function passes($data, $ruleset = []);

    /**
     * Errors.
     *
     * @return array
     */
    public function errors();
}
