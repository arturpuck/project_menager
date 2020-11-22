<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\FilterEmployeeReportsRequest;
use App\Models\Project;
use App\Repositories\ProjectsRepository;

Class FilterEmployeeReportsHandler{

    private ProjectsRepository $projectsRepository;

    public function __construct(ProjectsRepository $projectsRepository){

         $this->projectsRepository = $projectsRepository;
    }

    public function handle(FilterEmployeeReportsRequest $request){

       $employeeId = $request->get('employee_id');

       $this->projectsRepository->filterByEmployeeId($employeeId)
                                ->withUserProjectReports($employeeId)
                                ->limitCurrentUserProjectAccess();

        if($month = $request->get('month')){
            $this->projectsRepository->filterByMonth($month);
        }

        if($year = $request->get('year')){
            $this->projectsRepository->filterByYear($year);
        }

        $projects = $this->projectsRepository->get();
        return response()->json($projects->toArray());
    }
}