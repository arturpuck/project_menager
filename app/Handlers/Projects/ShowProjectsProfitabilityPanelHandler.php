<?php

namespace App\Handlers\Projects;

use App\Repositories\EmployeesRepository;
use App\Helpers\Months;
use App\Helpers\Company;


Class ShowProjectsProfitabilityPanelHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){

        $this->employeesRepository = $employeesRepository;
    }

    public function handle(){

     $projectMenagers = $this->employeesRepository 
                             ->filterByPositions(['project menager'])
                             ->get();

     $this->employeesRepository->resetQuery();  //może warto by zoptymalizować na 1 strzał do bazy

     $accounts = $this->employeesRepository 
                      ->filterByPositions(['account'])
                      ->get();
    

    $title = 'projects_profitability';
    $description = 'find_out_if_you_make_money_on_your_projects';
    $months = Months::names[\App::getLocale()];
    $yearsRange = Company::getYearsRange();

     return compact('projectMenagers', 'accounts', 'title', 'description', 'months', 'yearsRange');
    }
}