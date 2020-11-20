<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProjectStatus;

class ProjectReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $with = [
        'status'
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
}
