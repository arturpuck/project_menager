<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\Projects\ProjectsListHandler;
use App\Handlers\Projects\AddOrEditProjectHandler;
use App\Handlers\Projects\FilterProjectsHandler;
use App\Handlers\Projects\FilterProjectPaymentsHandler;
use App\Http\Requests\Projects\CreateOrEditProjectRequest;
use App\Http\Requests\Projects\FilterProjectRequest;
use App\Http\Requests\Projects\GetProjectsProfitabilityRequest;
use App\Http\Requests\Projects\FilterProjectPaymentsRequest;
use App\Http\Requests\Projects\UpdatePaymentStageRequest;
use App\Handlers\Projects\ShowProjectsProfitabilityPanelHandler;
use App\Handlers\Projects\GetProjectsProfitabilityHandler;
use App\Handlers\Projects\UpdatePaymentStageStatusHandler;
use App\Models\PaymentStatus;
use App\Helpers\Months;
use App\Helpers\Company;

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

    public function showProjectsProfitabilityPanel(ShowProjectsProfitabilityPanelHandler $projectsProfitabilityPanelHandler){

        $data =  $projectsProfitabilityPanelHandler->handle();
        return view('profitability')->with($data);
    }

    public function getProjectsProfitability(GetProjectsProfitabilityRequest $request, GetProjectsProfitabilityHandler $projectsProfitabilityHandler){
        return $projectsProfitabilityHandler->handle($request);
    }

    public function showIncomePanel(){

        return view('income')->with([
           'title' => 'projects_income',
           'description' => 'payments_and_invoices_list',
           'paymentStatuses' => PaymentStatus::all(),
           'months' => Months::names[\App::getLocale()],
           'yearsRange' => Company::getYearsRange()
        ]);
    }

    public function filterProjectsIncome(FilterProjectPaymentsRequest $request, FilterProjectPaymentsHandler $filterProjectPaymentsHandler){
         return $filterProjectPaymentsHandler->handle($request);
    }

    public function updatePaymentStage(UpdatePaymentStageRequest $request, UpdatePaymentStageStatusHandler $updatePaymentStageStatusHandler){
       return $updatePaymentStageStatusHandler->handle($request);
    }
}
