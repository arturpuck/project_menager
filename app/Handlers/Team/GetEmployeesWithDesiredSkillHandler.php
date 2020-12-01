<?php

namespace App\Handlers\Team;

use App\Repositories\EmployeesRepository;
use App\Http\Requests\Team\GetEmployeesWithDesiredSkillRequest;

Class GetEmployeesWithDesiredSkillHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){
        $this->employeesRepository = $employeesRepository;
    }

    public function handle(GetEmployeesWithDesiredSkillRequest $request){

        $employees = $this->employeesRepository->filterBySkillId($request->get('skill_id'))
                                                ->get();

        return response()->json($employees->toArray());
    }
}