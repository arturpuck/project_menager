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

        $clients = Client::all();
        $projects = Project::all();
        $tasks = Task::all();
        $employees = User::all();
        $paymentStatuses = PaymentStatus::all();
        $projectStatuses = ProjectStatus::all();

        $projectMenagersAndAccounts = $this->employeesRepository 
                          ->filterByPositions(['project menager', 'account'])
                          ->get();
                        
        $projectMenagers = $projectMenagersAndAccounts->filter(function($employee){ //możnaby filtrowanie gdzieś wydzielić do ponownego użycia
            
            $positions = $employee->positions->toArray();
         
            foreach($positions as $position){

                if($position['name'] == 'project menager'){
                    return true;
                }
            }
             return false;
        });


        $accounts = $projectMenagersAndAccounts->filter(function($employee){
           
            $positions = $employee->positions->toArray();

            foreach($positions as $position){
                
                if($position['name']  == 'account'){
                    return true;
                }
            }
             return false;
        });

        $months = Months::names[\App::getLocale()];
        $yearsRange = Company::getYearsRange();

        return compact('clients', 'projects', 'projectMenagers', 'tasks', 'paymentStatuses', 'employees', 'projectStatuses', 'months', 'yearsRange', 'accounts');
    }
}