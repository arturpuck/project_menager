<?php

namespace App\Handlers\Projects;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Project;
use App\Repositories\EmployeesRepository;
use App\Models\Task;
use App\Models\User;
use App\Models\PaymentStatus;
use App\Models\ProjectStatus;
use App\Helpers\Months;
use App\Helpers\Company;

Class ProjectsListHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){

        $this->employeesRepository = $employeesRepository;

    }

    public function handle(Request $request){


        $projectMenagers = $this->employeesRepository 
                          ->filterByPositions(['project menager'])
                          ->get();

        $this->employeesRepository->resetQuery();

        $accounts = $this->employeesRepository 
                          ->filterByPositions(['account'])
                          ->get();

                   return view('projects')->with([ 'clients' => Client::all(),
                                                  'projects' => Project::all(),
                                                  'projectMenagers' => $projectMenagers,
                                                  'accounts' => $accounts,
                                                  'paymentStatuses' => PaymentStatus::all(),
                                                  'projectStatuses' => ProjectStatus::all(),
                                                  'months' => Months::getNames(),
                                                  'title' => 'projects_list',
                                                  'description' => 'projects_list_description',
                                                  'tasks' => Task::all(),
                                                  'paymentStatuses' => PaymentStatus::all(),
                                                  'yearsRange' => Company::getYearsRange()]);

    
    }
}