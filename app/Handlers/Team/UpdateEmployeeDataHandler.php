<?php

namespace App\Handlers\Team;

use App\Repositories\EmployeesRepository;
use App\Http\Requests\Team\UpdateEmployeeDataRequest;
use App\Models\User;

Class UpdateEmployeeDataHandler {


    public function handle(UpdateEmployeeDataRequest $request){

        $employee = User::find($request->get('id'));
        $employee->phone_number = $request->get('phone_number');
        $employee->email = $request->get('email');

        if(\Auth::user()->is_ordinary_team_member){
            $employee->save();
            return response('data_modified_successfully');
        }
        $employee->full_name = $request->get('full_name');
        $employee->role_id = $request->get('role_id');
        $employee->rate_per_hour_set_by_deal = $request->get('rate_per_hour_set_by_deal');
        $employee->real_rate_per_hour = $request->get('real_rate_per_hour');
        $employee->rate_per_month = $request->get('rate_per_month');
        $employee->note = $request->get('note');
        $employee->save();
        $employee->positions()->sync($request->get('positions_ids'));
        $employee->skills()->sync($request->get('skills_ids'));

        return response('data_modified_successfully');
    }
}