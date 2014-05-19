<?php namespace Champ\Traits;

use Carbon\Carbon;

trait FormatToDb
{
    /**
     * Convert the date given to the correct format
     *
     * @param  string $value date in format dd/mm/yyyy hh:ii:ss
     * @return string        date in format yyyy-mm--dd hh:ii:ss
     */
    protected function formatToDb($value)
    {
        return Carbon::createFromFormat('d/m/Y', $value)->toDateTimeString();
    }
}