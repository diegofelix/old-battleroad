<?php

namespace Champ\Validators\Core;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

abstract class AbstractValidator
{
    /**
     * A collection of validation errors.
     *
     * @var Illuminate\Support\Collection
     */
    protected $errors;

    /**
     * Validation rules for this Validator.
     *
     * @var array
     */
    protected $rules = [];

    /**
     * An array of custom validation messages.
     *
     * @var array
     */
    protected $messages = [];

    /**
     * Set the intial errors collection.
     */
    public function __construct()
    {
        $this->errors = new Collection();
    }

    /**
     * Validate the provided data using the
     * internal rules array.
     *
     * @param mixed $data
     *
     * @return bool
     */
    public function passes($data, $ruleset = 'create')
    {
        // We allow collections, so transform to array.
        if ($data instanceof Collection) {
            $data = $data->toArray();
        }

        // Load the correct ruleset.
        $rules = $this->rules[$ruleset];

        // Create the validator instance and validate.
        $validator = Validator::make($data, $rules, $this->messages);

        if (!$result = $validator->passes()) {
            $this->errors = $validator->messages();
        }

        // Return the validation result.
        return $result;
    }

    /**
     * Return the error collection after a failed
     * validation attempt.
     *
     * @return Illuminate\Support\Collection
     */
    public function errors()
    {
        return $this->errors;
    }
}
