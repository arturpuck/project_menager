<?php

namespace App\Repositories;

use App\Models\Project;


Class ProjectsRepository extends BaseRepository {

    public const MODEL_NAME = Project::class;

    public function filterByClientId($clientId): ProjectsRepository {

         $this->query = $this->query->where('client_id', $clientId);
         return $this;
    }

    public function filterByTaskId($taskId): ProjectsRepository {
        $this->query = $this->query->where('task_id', $taskId);
         return $this;
    }

    public function filterByStatusId($statusId): ProjectsRepository {
        $this->query = $this->query->where('status_id', $statusId);
         return $this;
    }

    public function filterByMonth($monthNumber): ProjectsRepository {
        $this->query = $this->query->whereMonth('created_at', $monthNumber);
         return $this;
    }

    public function filterByYear($year): ProjectsRepository {
         $this->query = $this->query->whereYear('created_at', $year);
         return $this;
    }

    public function addCurrentUserRoleRestrictions() : ProjectsRepository{

         if(\Auth::user()->is_admin){
              return $this;
         }
         else{
              
              $this->query = $this->query->whereHas('employees', function($query){
                  $query->where('full_name', \Auth::user()->full_name);
               });
          
         }
    }

    
}