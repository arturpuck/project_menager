<?php

namespace App\Handlers\Team;

use App\Repositories\EmployeesRepository;
use App\Http\Requests\Team\GetUserClockifyReportsRequest;
use App\Models\UserClockifyReport;

Class GetUserClockifyReportHandler {


    public function handle(GetUserClockifyReportsRequest $request){

        $reports = UserClockifyReport::where('user_id', $request->get('employee_id'))
                                       ->orderBy('report_date', 'desc')
                                       ->get();

        return response()->json($reports->toArray());
    }
}