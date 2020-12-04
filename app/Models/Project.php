<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;
use App\Models\PaymentStage;
use App\Models\TaskStage;
use App\Models\Client;
use App\Models\ProjectStatus;
use App\Models\ProjectReport;


class Project extends Model
{
    use HasFactory;

    public $with = [
        'taskStages',
        'client'
    ];

    public function projectReports(){
        return $this->hasMany(ProjectReport::class);
    }

    public function employees(){
        return $this->belongsToMany(User::class,'project_has_user');
    }

    public function paymentStages(){
        return $this->hasMany(PaymentStage::class);
    }

    public function taskStages(){
        return $this->hasMany(TaskStage::class);
    }

    public function projectMenager(){
        return $this->belongsTo(User::class, 'project_menager_id');
    }

    public function account(){
        return $this->belongsTo(User::class, 'account_id');
    }

    public function client(){
        return $this->belongsTo(Client::class);
    }

    public function status(){
        return $this->belongsTo(ProjectStatus::class);
    }

    public function lastPaymentStage(){

        return $this->paymentStages()
                     ->latest('estimated_payment_date')
                     ->take(1);
    }

    public function projectReportsForCurrentMonth(){

        return $this->projectReports()
                    ->whereMonth('updated_at', date('m'));
    }

    public static function canBeEditedByCurrentUser(int $projectID): bool{
        
        if(\Auth::user()->is_admin){
            return true;
        }
        $userID = \Auth::user()->id;
        
        return self::where('id',$projectID)->where(function($query) use ($userID){
            $query->where('project_menager_id', )->orWhere('account_id',$userID);
       })->exists();
    }
}
