<?php

namespace App\Handlers\Team;

use App\Repositories\EmployeesRepository;

Class ShowEmployeesListHandler {

    private EmployeesRepository $employeesRepository;

    public function __construct(EmployeesRepository $employeesRepository){
        $this->employeesRepository = $employeesRepository;
    }

    public function handle(){

        $employees = $this->employeesRepository->with(['positions', 'skills', 'role'])
                                                 ->limitCurrentUserEmployeeAccess()
                                                 ->get();

        return response()->json($employees->toArray());
    }
}