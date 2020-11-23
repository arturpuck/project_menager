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

    public static function filterCollectionByEmployeePosition(Collection $employees, string $requiredPosition){

        $result = $employees->filter(function($employee){ 
            
            $positions = $employee->positions->toArray();
         
            foreach($positions as $position){

                if($position['name'] == $requiredPosition){
                    return true;
                }
            }
             return false;
        });
    }
}