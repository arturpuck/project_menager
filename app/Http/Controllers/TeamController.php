<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Team\StoreReportRequest;
use App\Http\Requests\Team\FilterEmployeeReportsRequest;
use App\Http\Requests\Team\CreateOrEditProjectReportRequest;
use App\Http\Requests\Team\UpdateEmployeeDataRequest;
use App\Handlers\Team\StoreReportHandler;
use App\Handlers\Team\CreateOrEditProjectReportHandler;
use App\Handlers\Team\ShowEmployeesListHandler;
use App\Handlers\Team\FilterEmployeeReportsHandler;
use App\Handlers\Team\UpdateEmployeeDataHandler;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ProjectReportStatus;
use App\Helpers\Company;
use App\Helpers\Months;
use App\Models\Role;
use App\Models\Position;
use App\Models\Skill;

class TeamController extends Controller
{
   public function showList(){
       
       return view('team')->with([
           'title' => 'team_list_title',
           'description' => 'team_list_description',
           'projectReportStatuses' => ProjectReportStatus::all(),
           'months' => Months::names[\App::getLocale()],
           'yearsRange' => Company::getYearsRange(),
           'roles' => Role::all(),
           'positions' => Position::all(),
           'skills' => Skill::all()
       ]);
   }

   public function getAll(ShowEmployeesListHandler $employeesListHandler) : Response{
      return $employeesListHandler->handle();
   }

   public function storeReport(StoreReportRequest $request, StoreReportHandler $storeReportHandler){
        return $storeReportHandler->handle($request);
   }

   public function filterReports(FilterEmployeeReportsRequest $request, FilterEmployeeReportsHandler $filterEmployeeReportsHandler){
       return $filterEmployeeReportsHandler->handle($request);
   }

   public function storeProjectReport(CreateOrEditProjectReportRequest $request, CreateOrEditProjectReportHandler $projectReportHandler){
       return $projectReportHandler->handle($request);
   }

   public function updateEmployeeData(UpdateEmployeeDataRequest $request, UpdateEmployeeDataHandler $updateEmployeeDataHandler){
       return $updateEmployeeDataHandler->handle($request);
   }
}
