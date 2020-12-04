<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Team\StoreReportRequest;
use App\Http\Requests\Team\FilterEmployeeReportsRequest;
use App\Http\Requests\Team\CreateOrEditProjectReportRequest;
use App\Http\Requests\Team\UpdateEmployeeDataRequest;
use App\Http\Requests\Team\GetEmployeesWithDesiredSkillRequest;
use App\Http\Requests\Team\CreateNewEmployeeRequest;
use App\Handlers\Team\StoreReportHandler;
use App\Handlers\Team\CreateOrEditProjectReportHandler;
use App\Handlers\Team\ShowEmployeesListHandler;
use App\Handlers\Team\FilterEmployeeReportsHandler;
use App\Handlers\Team\UpdateEmployeeDataHandler;
use App\Handlers\Team\GetEmployeesWithDesiredSkillHandler;
use App\Handlers\Team\ShowTeamMainPageHandler;
use App\Handlers\Team\CreateNewEmployeeHandler;
use Symfony\Component\HttpFoundation\Response;


class TeamController extends Controller
{
   public function showList(ShowTeamMainPageHandler $teamMainPageHandler){
       return $teamMainPageHandler->handle();
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

   public function getEmployeesWithDesiredSkill(GetEmployeesWithDesiredSkillRequest $request, GetEmployeesWithDesiredSkillHandler $employeesWithDesiredSkillHandler){
        return $employeesWithDesiredSkillHandler->handle($request);
   }

   public function createNewEmployee(CreateNewEmployeeRequest $request, CreateNewEmployeeHandler $newEmployeeHandler){
        return $newEmployeeHandler->handle($request);
   }
}
