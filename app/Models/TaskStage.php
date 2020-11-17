<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;

class TaskStage extends Model
{
    use HasFactory;
    protected $table = 'task_stages';
    public $with = ['task', 'employee'];
    protected $fillable = [
       'task_id',
       'employee_id',
       'project_id',
       'estimated_time_of_work',
       'estimated_amount_of_money',
       'start_at',
       'deadline'
    ];

    public function task(){
        return $this->belongsTo(Task::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }

}
