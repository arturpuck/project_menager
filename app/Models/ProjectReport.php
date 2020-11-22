<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectStatus;
use App\Models\User;

class ProjectReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $with = [
        'status',
        'employee'
    ];

    protected $fillable = [
        'user_id',
        'project_id',
        'time_spent',
        'comment',
        'updated_at',
        'status_id'
    ];

    public function status(){
       return $this->belongsTo(ProjectStatus::class);
    }

    public function employee(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
