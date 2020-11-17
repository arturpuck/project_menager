<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EmployeePosition;
use App\Models\EmployeeRole;
use App\Models\Skill;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'status',
        'email',
        'phone_number',
        'rate_per_hour',
        'rate_per_month',
        'role_id',
        'note'
    ];

    public function position(){
        return $this->belongsTo(EmployeePosition::class);
    }

    public function role(){
        return $this->belongsTo(EmployeeRole::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'employee_has_skill');
     }
 
}
