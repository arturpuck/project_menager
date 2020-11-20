<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\StoreReportRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\UserClockifyReport;
use App\Models\User;


Class StoreReportHandler {

    public function handle(StoreReportRequest $request){

        
            $file = $request->file('clockify_report_file');
            $currentDate = date('Y-m-d');
            $userID = $request->get('user_id');
            $user = User::with('clockifyReportForCurrentMonth')->find($userID);
           
            if($user->has_clockify_report_for_current_month){
                Storage::disk('public')->delete($user->clockify_report_file_for_current_month_path);
            }
            
            $extension = $file->getClientOriginalExtension();
            $dateUnderscored = str_replace('-','_',$currentDate);
            $userName = str_replace(' ','_', $user->full_name);
            $fileName = $dateUnderscored.'_'.$userName.'.'.$extension;
           
            $file->storeAs('/reports', $fileName, 'public');

            UserClockifyReport::updateOrCreate(
                [
                  'report_date' => $currentDate,
                  'user_id' => $userID
                ],
                [
                  'reported_hours' => $request->get('reported_hours'),
                  'report_file_name' =>$fileName
                ]);

            return back()->with('succesMessage', 'report_added_successfully');

        
    }
}