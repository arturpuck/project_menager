<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Employee;


class Project extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->belongsToMany(Task::class,'project_has_task');
    }

    public function employees(){
        return $this->belongsToMany(Employee::class,'project_has_employee');
    }
}
