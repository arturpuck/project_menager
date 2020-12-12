<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\StoreReportRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\UserClockifyReport;
use App\Models\User;


Class StoreReportHandler {

    public function handle(StoreReportRequest $request){

            $file = $request->file('clockify_report_file');
            $userID = $request->get('user_id');
            $user = User::find($userID);
            $reportForMonth = $request->get('report_for_month');

            if(\Auth::user()->is_ordinary_team_member){
              $currentMonth = date('m');
              $currentYear = date('Y');
              $reportForYear = (($currentMonth == 1) and ($reportForMonth == 12)) ? ($currentYear - 1) : $currentYear;
            }
            else{
              $reportForYear = $request->get('report_for_year');
            }
            
            $fixedDayJustForColumnPurposes = '28';

            if($clockifyReport = $user->clockifyReport($reportForMonth, $reportForYear)->get()->first()){
                Storage::disk('public')->delete($clockifyReport->file_path);
            }
            $reportData = $reportForYear.'-'.$reportForMonth.'-'.$fixedDayJustForColumnPurposes;
            $extension = $file->getClientOriginalExtension();
            $dateUnderscored = str_replace('-','_',$reportData);
            $userName = str_replace(' ','_', $user->full_name);
            $fileName = $dateUnderscored.'_'.$userName.'.'.$extension;
           
            $file->storeAs('/reports', $fileName, 'public');

            UserClockifyReport::updateOrCreate(
                [
                  'report_date' => $reportData,
                  'user_id' => $userID
                ],
                [
                  'reported_hours' => $request->get('reported_hours'),
                  'report_file_name' =>$fileName
                ]);

            return back()->with('succesMessage', 'report_added_successfully');

        
    }
}