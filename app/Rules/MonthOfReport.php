<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Helpers\Months;

class MonthOfReport implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return \Auth::user()->is_ordinary_team_member ? 
               in_array($value, Months::numbersOfCurrentMonthAndPrevious()) : 
               in_array($value, Months::getAlMonthsParsedNumbers());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the_selected_month_is_invalid_you';
    }
}
