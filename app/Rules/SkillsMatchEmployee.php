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
    
    private array $skillIds;
    private array $userIds;
    private string $errorMessage;

    public function __construct(array $skillIds, array $userIds)
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
        if(count($this->skillIds) !== count($this->userIds)){
           $this->errorMessage = 'number_of_skills_must_be_equal_to_number_of_users';
           return false;
        }

        foreach($this->userIds as $index => $userId){

            $skillId = $this->skillIds[$index];
            
            $userHasSuchSkill = User::where('id',$userId)->whereHas('skills', function($query) use ($skillId){
                 $query->where('skills.id', $skillId);
            })->exists();

            if(!$userHasSuchSkill){
                $this->errorMessage = 'skills_where_assigned_to_aa_incorrect_user';
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
        return $this->errorMessage;
    }
}
