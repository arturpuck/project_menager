<?php

namespace App\Repositories;

use App\Models\User;


Class EmployeesRepository extends BaseRepository {

    public const MODEL_NAME = User::class;

    public function filterByPositions(array $statuses): EmployeesRepository {

         $this->query = $this->query->whereHas('positions', function($query) use ($statuses){
                 $query->whereIn('name',$statuses);
         });
         return $this;
    }
}