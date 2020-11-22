<?php

namespace App\Repositories;

use App\Models\Project;


Class ProjectsRepository extends BaseRepository {

    public const MODEL_NAME = Project::class;

    public function filterByClientId($clientId): ProjectsRepository {

         $this->query = $this->query->where('client_id', $clientId);
         return $this;
    }

    public function filterByTask($task): ProjectsRepository {
         
        $this->query = $this->query->whereHas('tasks', function($query) use ($task){
            $query->where('name',$task);
        });

        return $this;
    }

    public function filterByStatusId($statusId): ProjectsRepository {
        $this->query = $this->query->where('status_id', $statusId);
         return $this;
    }

    public function filterByEmployeeId(int $employeeId): ProjectsRepository {

     $this->query = $this->query->whereHas('employees', function($query) use ($employeeId){
          $query->where('user_id', $employeeId);
     });
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

    public function limitCurrentUserProjectAccess() : ProjectsRepository{

         if(!\Auth::user()->is_admin){
             $this->query = $this->query->whereHas('employees', function($query){
               $query->where('user_id', \Auth::user()->id);
              });
         }
        return $this;
    }

    public function withUserProjectReports($userId): ProjectsRepository{

         $this->query = $this->query->with(['projectReports' => function($query) use ($userId){
              $query->where('user_id',$userId);
         }]);
         return $this;
    }

    public function limitCurrentUserProfitabilityAccess(): ProjectsRepository{

         if(!\Auth::user()->is_admin){
              $this->query = $this->query->where('project_menager_id', \Auth::user()->id)
                                          ->orWhere('account_id',  \Auth::user()->id);
         }
         return $this;
    }

   public function filterById($projectId): ProjectsRepository{
        $this->query = $this->query->where('id', $projectId);
        return $this;
   }

   public function filterByProjectMenagerId($projectMenagerId): ProjectsRepository{

     $this->query = $this->query->where('project_menager_id', $projectMenagerId);
     return $this;
   }

   public function filterByAccountId($accountId): ProjectsRepository{

     $this->query = $this->query->where('account_id', $accountId);
     return $this;
   }

   public function attachOnlyReceivedPaymentStages(){

        $this->query = $this->query->with(['paymentStages' => function($query){

              $query->whereHas('paymentStatus', function($query){
                   $query->where('name', 'paid');
              });
        }]);

        return $this;
   }

    
}