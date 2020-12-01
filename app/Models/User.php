<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Project;
use App\Models\Role;
use App\Models\Position;
use App\Models\TaskStage;
use App\Models\UserClockifyReport;
use App\Models\ProjectReport;

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

    public function taskStages(){
        return $this->hasMany(TaskStage::class);
    }
    
    public function projects(){
        return $this->belongsToMany(Project::class,'project_has_user');
    }

    public function projectReports(){
        return $this->hasMany(ProjectReport::class);
    }

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

    public function getIsOrdinaryTeamMemberAttribute():bool{
        return $this->role->name == 'team member';
    }

    public function getCanAddOrEditProjectsAttribute(){
        return !$this->is_ordinary_team_member;
    }

    public function clockifyReports(){
           return $this->hasMany(UserClockifyReport::class);
    }

    public function clockifyReportForCurrentMonth(){

        return $this->hasMany(UserClockifyReport::class)
                    ->whereMonth('report_date', date('m'))
                    ->whereYear('report_date', date('Y'));
    }

    public function getHasClockifyReportForCurrentMonthAttribute(){
        return $this->clockifyReportForCurrentMonth()->exists();
    }

    public function getClockifyReportFileForCurrentMonthNameAttribute(){
       return $this->clockifyReportForCurrentMonth->first()->report_file_name;
    }

    public function getClockifyReportFileForCurrentMonthPathAttribute():string{
        return "/reports/".$this->clockify_report_file_for_current_month_name;
    }

    public function canModifyOrEditOtherUser(int $userId):bool{

          switch($this->role->name){

              case 'administrator':
                return true;
              break;

              case 'project menager':
                 return ($this->id == $userId) || User::find($userId)->is_ordinary_team_member;
              break;

              case 'account':
                return ($this->id == $userId) || User::find($userId)->is_ordinary_team_member;
              break;

              case 'team member':
                 return $this->id == $userId;
              break;
          }
    }
    
 
}
