<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\CreateOrEditProjectReportRequest;
use App\Models\ProjectReport;


Class CreateOrEditProjectReportHandler{


    public function handle(CreateOrEditProjectReportRequest $request){

        $currentYear = intval(date('Y'));
        $currentMonth = date('m');
        $reportForMonth = $request->get('update_month');
        $updateYear = (($reportForMonth == 12) and ($currentMonth == 1)) ? $currentYear - 1 : $currentYear;
        $updateDate = $updateYear.'-'.$reportForMonth.'-28';

          ProjectReport::updateOrCreate(
              [
                'user_id' => $request->get('employee_id'),
                'project_id' => $request->get('project_id'),
                'updated_at' => $updateDate
              ],
              [
                  'time_spent' => $request->get('time'),
                  'comment' => $request->get('comment'),
                  'status_id' => $request->get('status_id')
              ]
          );

          return response('report_modified_successfully');
    }
}