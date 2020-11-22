<?php

namespace App\Handlers\Projects;

use App\Repositories\ProjectsRepository;
use App\Http\Requests\Projects\GetProjectsProfitabilityRequest;
use Symfony\Component\HttpFoundation\Response;

Class GetProjectsProfitabilityHandler {

    private ProjectsRepository $projectsRepository;

    public function __construct(ProjectsRepository $projectsRepository){

        $this->projectsRepository = $projectsRepository;
    }

    public function handle(GetProjectsProfitabilityRequest $request) : Response{
        
       $this->projectsRepository->with(['projectReports', 'paymentStages', 'projectMenager', 'account'])
                                              ->attachOnlyReceivedPaymentStages()
                                              ->limitCurrentUserProfitabilityAccess();
        
        if($projectId = $request->get('project_id')){
           $this->projectsRepository->filterById($projectId);
        }

        if($projectMenagerId = $request->get('project_menager_id')){
            $this->projectsRepository->filterByProjectMenagerId($projectMenagerId);
        }

        if($accountId = $request->get('account_id')){
            $this->projectsRepository->filterByAccountId($accountId);
        }
        $projects = $this->projectsRepository->get();

        return response()->json($projects->toArray());
    }
}