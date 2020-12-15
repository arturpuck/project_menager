<?php

namespace App\Handlers\Team;

use App\Http\Requests\Team\ChangeEmployeePasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


Class ChangeEmployeePasswordHandler {


    public function handle(ChangeEmployeePasswordRequest $request){

        $user = User::find($request->get('employee_id'));
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return response('password_changed_successfully');
    }
}