<?php

namespace App\Handlers\Projects;

use App\Repositories\ProjectsRepository;
use App\Http\Requests\Projects\FilterProjectRequest;
use Symfony\Component\HttpFoundation\Response;

Class FilterProjectsHandler {

    private ProjectsRepository $projectsRepository;

    public function __construct(ProjectsRepository $projectsRepository){

        $this->projectsRepository = $projectsRepository;
    }

    public function handle(FilterProjectRequest $request) : Response{
        
        if($clientId = $request->get('client_id')){
           $this->projectsRepository->filterByClientId($clientId);
        }

        if($taskId = $request->get('task')){
            $this->projectsRepository->filterByTask($taskId);
         }

         if($statusId = $request->get('status_id')){
            $this->projectsRepository->filterByStatusId($statusId);
         }

         if($month = $request->get('month')){
            $this->projectsRepository->filterByMonth($month);
         }

         if($year = $request->get('year')){
            $this->projectsRepository->filterByYear($year);
         }

         if($projectMenagerID = $request->get('project_menager_id')){
            $this->projectsRepository->filterByProjectMenagerId($projectMenagerID);
         }

         if($accountID = $request->get('account_id')){
            $this->projectsRepository->filterByAccountId($accountID);
         }

         $projects =  $this->projectsRepository->with(['employees', 
                                                      'paymentStages', 
                                                      'taskStages', 
                                                      'projectMenager',
                                                      'account',
                                                      'status',
                                                      'client'])
                                                      ->limitCurrentUserProjectAccess()
                                                      ->get();

         return response()->json($projects->toArray());
    }
}