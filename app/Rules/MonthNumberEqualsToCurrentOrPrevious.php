<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Helpers\Months;

class MonthNumberEqualsToCurrentOrPrevious implements Rule
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
        return in_array($value, Months::numbersOfCurrentMonthAndPrevious());
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the_selected_month_is_invalid_you_can_choose_only_current_or_previous_one';
    }
}
