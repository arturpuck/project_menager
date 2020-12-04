<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Role;

class CurrentUserCanAssignRole implements Rule
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
        switch(\Auth::user()->role->name){

            case 'administrator':
               return true;
            break;

            case 'project menager':
               return Role::find($value)->name !== 'administrator';
            break;

            case 'account':
                return Role::find($value)->name !== 'administrator';
             break;

             case 'team member':
               return false;
             break;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'you_are_not_allowed_to_assign_this_role';
    }
}
