<?php

namespace App\Repositories;

use App\Models\Employee;


Class EmployeesRepository extends BaseRepository {

    public const MODEL_NAME = Employee::class;

    public function filterByStatus(string $status): EmployeesRepository {

         $this->query = $this->query->where('status', $status);
         return $this;
    }
}