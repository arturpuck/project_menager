<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\CreateOrEditProjectReportRequest;
use App\Models\ProjectReport;


Class CreateOrEditProjectReportHandler{


    public function handle(CreateOrEditProjectReportRequest $request){

          ProjectReport::updateOrCreate(
              [
                'user_id' => $request->get('employee_id'),
                'project_id' => $request->get('project_id')
              ],
              [
                  'time_spent' => $request->get('time'),
                  'comment' => $request->get('comment'),
                  'updated_at' => $request->get('update_date'),
                  'status_id' => $request->get('status_id')
              ]
          );

          return response('report_modified_successfully');
    }
}