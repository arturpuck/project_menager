<?php

namespace App\Handlers\Projects;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Repositories\EmployeesRepository;
use App\Models\Task;

Class ProjectsListHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){

        $this->employeesRepository = $employeesRepository;

    }

    public function handle(Request $request){

        $clients = Client::all();
        $projects = Project::all();
        $tasks = Task::all();

        $projectMenagers = $this->employeesRepository
                          ->select(['full_name'])
                          ->filterByStatus('project menager')
                          ->get();

        return compact('clients', 'projects', 'projectMenagers', 'tasks');
    }
}