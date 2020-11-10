<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\Projects\ProjectsListHandler;
use App\Requests\Projects\CreateOrEditProjectRequest;

class ProjectsController extends Controller
{
    public function showProjects(Request $request, ProjectsListHandler $projectsListHandler){
        
        $data = $projectsListHandler->handle($request);
        
        return view('main_panel.projects')->with([
            'title' => 'projects_list',
            'description' => 'projects_list_description',
            'clients' => $data['clients'],
            'projects' => $data['projects'],
            'projectMenagers' => $data['projectMenagers'],
            'paymentStatuses' => $data['paymentStatuses'],
            'projectStatuses' => $data['projectStatuses'],
            'tasks' => $data['tasks'],
            'employees' => $data['employees']
        ]);
    }

    public function addProject(CreateOrEditProjectRequest $request){
          
    }
}
