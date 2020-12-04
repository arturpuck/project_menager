<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\CreateNewEmployeeRequest;
use App\Models\ProjectReport;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


Class CreateNewEmployeeHandler{

    public function handle(CreateNewEmployeeRequest $request){

        $employee = new User();
        $employee->login = $request->get('login');
        $employee->phone_number = $request->get('phone_number');
        $employee->email = $request->get('email');
        $employee->role_id = $request->get('role_id');
        $employee->full_name = $request->get('full_name');
        $employee->rate_per_hour_set_by_deal = $request->get('rate_per_hour_set_by_deal');
        $employee->real_rate_per_hour = $request->get('real_rate_per_hour');
        $employee->rate_per_month = $request->get('rate_per_month');
        $employee->note = $request->get('note');
        $employee->password = Hash::make($request->get('password'));
        $employee->save();
        $employee->positions()->sync($request->get('positions_ids'));
        $employee->skills()->sync($request->get('skills_ids'));

        return response('user_created_successfully');
          
    }
}