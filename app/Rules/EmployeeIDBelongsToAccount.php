<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class EmployeeIDBelongsToAccount implements Rule
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
        return User::where('id',intval($value))->where(function($query) use ($value){

            $query->whereHas('role', function($query){
                $query->where('name', 'account');
            })->orWhereHas('positions', function($query){
                $query->where('name', 'account');
            });
            
        })->exists(); 
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'the_selected_account_is_invalid';
    }
}
