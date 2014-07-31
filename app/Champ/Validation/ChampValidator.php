<?php namespace Champ\Validation;

use Illuminate\Validation\Validator;
use InvalidArgumentException;
use Carbon\Carbon;

class ChampValidator extends Validator {

    /**
     * Check if the date passed is a date greater than the actual date
     *
     * @param   $attribute
     * @param   $value
     * @param   $parameters
     * @return  boolean
     */
    public function validateFutureDate($attribute, $value, $parameters)
    {
        $now  = Carbon::now();
        try
        {
            $date = Carbon::createFromFormat('d/m/Y', $value);
            return $date > $now;
        }
        catch (InvalidArgumentException $e)
        {
            return false;
        }

    }

    /**
     * Replace the default text
     *
     * @param  string $message
     * @param  string $attribute
     * @param  string $rule
     * @param  array $parameters
     * @return string
     */
    protected function replaceFutureDate($message, $attribute, $rule, $parameters)
    {
        return str_replace(':future_date', $attribute, 'O campo :future_date precisa ser uma data maior que hoje.');
    }

}