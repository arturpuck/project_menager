<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class SkillsMatchEmployee implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    private $skillIds;
    private $userIds;

    public function __construct($skillIds, $userIds)
    {
        $this->skillIds = $skillIds;
        $this->userIds = $userIds;
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
        if(!is_array($this->skillIds) || !is_array($this->userIds)){
            return false;
        }
        
        if(count($this->skillIds) !== count($this->userIds)){
           return false;
        }

        foreach($this->userIds as $index => $userId){

            $skillId = $this->skillIds[$index];

            $userHasSuchSkill = User::find($userId)->skills()
                                                   ->leftJoin('tasks', 'skills.name', '=', 'tasks.name')
                                                   ->where('tasks.id',$skillId)
                                                   ->exists();

            if(!$userHasSuchSkill){
                return false;
            }
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        'skills_do_not_match_chosen_employees';
    }
}
