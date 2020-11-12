<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStage extends Model
{
    use HasFactory;
    protected $table = 'task_stages';
    protected $fillable = [
       'task_id',
       'employee_id',
       'project_id',
       'estimated_time_of_work',
       'estimated_amount_of_money',
       'start_at',
       'deadline'
    ];

}
