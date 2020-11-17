<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Position;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'login',
        'password',
        'email',
        'full_name',
        'status',
        'email',
        'phone_number',
        'rate_per_hour',
        'rate_per_month',
        'role_id',
        'note'
    ];

    public $with = [
        'role',
        'positions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function positions(){
        return $this->belongsToMany(Position::class, 'user_has_position');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'user_has_skill');
    }

    public function getIsAdminAttribute():bool{
        return $this->role->name == 'administrator';
    }

    public function getIsProjectMenagerAttribute():bool{
        return $this->role->name == 'project menager';
    }

    public function getIsAccountAttribute():bool{
        return $this->role->name == 'account';
    }

    public function getCanAddProjectsAttribute(){
        return $this->is_admin || $this->is_project_menager;
    }
 
}
