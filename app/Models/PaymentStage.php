<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\PaymentStatus;
use App\Models\Project;
use App\Models\Client;

class PaymentStage extends Model
{
    use HasFactory;

    protected $table = 'payment_stages';
    protected $fillable = [
       'name',
       'project_id',
       'ammount',
       'estimated_payment_date',
       'payment_status_id',
    ];

    public $with = [
      'paymentStatus'
    ];

    public function paymentStatus(){
        return $this->belongsTo(PaymentStatus::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }

}
