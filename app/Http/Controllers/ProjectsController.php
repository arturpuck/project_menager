<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\Projects\ProjectsListHandler;

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
            'tasks' => $data['tasks'],
            'employees' => $data['employees']
        ]);
    }
}
