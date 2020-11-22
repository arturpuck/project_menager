<?php

namespace App\Handlers\Projects;

use App\Repositories\ProjectsRepository;
use App\Repositories\EmployeesRepository;


Class ShowProjectsProfitabilityPanelHandler {

    private ProjectsRepository $projectsRepository;
    private EmployeesRepository $employeesRepository;

    public function __construct(ProjectsRepository $projectsRepository, EmployeesRepository $employeesRepository){

        $this->projectsRepository = $projectsRepository;
        $this->employeesRepository = $employeesRepository;
    }

    public function handle(){

      $availableProjects =  $this->projectsRepository->with(['projectReports','paymentStages'])
                                 ->limitCurrentUserProfitabilityAccess()
                                 ->get();

     $projectMenagers = $this->employeesRepository 
                             ->filterByPositions(['project menager'])
                             ->get();

     $this->projectsRepository->resetQuery();  //może warto by zoptymalizować na 1 strzał do bazy

     $accounts = $this->employeesRepository 
                      ->filterByPositions(['account'])
                      ->get();
    

    $title = 'projects_profitability';
    $description = 'find_out_if_you_make_money_on_your_projects';

     return compact('availableProjects', 'projectMenagers', 'accounts', 'title', 'description');
    }
}