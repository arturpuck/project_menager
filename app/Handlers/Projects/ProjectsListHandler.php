<?php

namespace App\Handlers\Projects;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Repositories\EmployeesRepository;
use App\Models\Task;
use App\Models\Employee;
use App\Models\PaymentStatus;
use App\Models\ProjectStatus;

Class ProjectsListHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){

        $this->employeesRepository = $employeesRepository;

    }

    public function handle(Request $request){

        $clients = Client::all();
        $projects = Project::all();
        $tasks = Task::all();
        $employees = Employee::all();
        $paymentStatuses = PaymentStatus::all();
        $projectStatuses = ProjectStatus::all();

        $projectMenagers = $this->employeesRepository
                          ->filterByStatus('project menager')
                          ->get();

        return compact('clients', 'projects', 'projectMenagers', 'tasks', 'paymentStatuses', 'employees', 'projectStatuses');
    }
}