<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\Employee;
use App\Models\PaymentStage;
use App\Models\TaskStage;
use App\Models\Client;
use App\Models\ProjectStatus;


class Project extends Model
{
    use HasFactory;

    public function tasks(){
        return $this->belongsToMany(Task::class,'project_has_task');
    }

    public function employees(){
        return $this->belongsToMany(Employee::class,'project_has_employee');
    }

    public function paymentStages(){
        return $this->hasMany(PaymentStage::class);
    }

    public function taskStages(){
        return $this->hasMany(TaskStage::class);
    }

    public function projectManager(){
        return $this->belongsTo(Employee::class, 'project_manager_id');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function status(){
        return $this->belongsTo(ProjectStatus::class);
    }
}
