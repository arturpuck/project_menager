<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\Projects\ProjectsListHandler;
use App\Handlers\Projects\AddOrEditProjectHandler;
use App\Handlers\Projects\FilterProjectsHandler;
use App\Http\Requests\Projects\CreateOrEditProjectRequest;
use App\Http\Requests\Projects\FilterProjectRequest;

class ProjectsController extends Controller
{
    public function showProjects(Request $request, ProjectsListHandler $projectsListHandler){
        
        $data = $projectsListHandler->handle($request);
        
        return view('main_panel.projects')->with([ //trzeba przerzucić
            'title' => 'projects_list',
            'description' => 'projects_list_description',
            'clients' => $data['clients'],
            'projects' => $data['projects'],
            'projectMenagers' => $data['projectMenagers'],
            'accounts' => $data['accounts'],
            'paymentStatuses' => $data['paymentStatuses'],
            'projectStatuses' => $data['projectStatuses'],
            'tasks' => $data['tasks'],
            'employees' => $data['employees'],
            'months' => $data['months'],
            'yearsRange' => $data['yearsRange']
        ]);
    }

    public function addOrEditProject(CreateOrEditProjectRequest $request, AddOrEditProjectHandler $addOrEditProjectHandler){

          return $addOrEditProjectHandler->handle($request);
    }

    public function filterProjects(FilterProjectRequest $request, FilterProjectsHandler $filterProjectsHandler){
          return $filterProjectsHandler->handle($request);
    }
}
