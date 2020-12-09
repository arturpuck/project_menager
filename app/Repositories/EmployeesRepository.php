<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Collection;


Class EmployeesRepository extends BaseRepository {

    public const MODEL_NAME = User::class;

    public function filterByPositions(array $statuses): EmployeesRepository {

         $this->query = $this->query->whereHas('positions', function($query) use ($statuses){
                 $query->whereIn('name',$statuses);
         })->orWhereHas('role', function($query) use ($statuses){
             $query->whereIn('name',$statuses);
         });

         return $this;
    }

    public function filterBySkillId(int $skillId): EmployeesRepository {

        $this->query = $this->query->whereHas('skills', function($query) use ($skillId){
             $query->where('skills.id',$skillId);
        });

        return $this;
    }

    public function filterByTaskStageId(int $skillId): EmployeesRepository {

        $this->query = $this->query->whereHas('skills', function($query) use ($skillId){

             $query->leftJoin('tasks', 'skills.name', '=', 'tasks.name')
                   ->where('tasks.id',$skillId);
        });

        return $this;
    }

    public function filterBySkill(string $skill): EmployeesRepository {

        $this->query = $this->query->whereHas('skills', function($query) use ($skill){
             $query->where('name',$skill);
        });

        return $this;
    }

    private function limitsForProjectMenagersAndAccounts(){

        return $this->query->where(function($query){

            $query->where('id', \Auth::user()->id);
            
            $query->orWhereHas('role', function($query){
                $query->where('name', 'team member');
            });
        });
    }

    public function limitCurrentUserEmployeeAccess(): EmployeesRepository {

        switch(\Auth::user()->role->name){

            case 'administrator':
              return $this;
            break;

            case 'project menager':
              $this->query = $this->limitsForProjectMenagersAndAccounts();
            break;

            case 'account':
                $this->query = $this->limitsForProjectMenagersAndAccounts();
            break;

            case 'team member':
              $this->query->where('id', \Auth::user()->id);
            break;
        }

        return $this;

    }

}