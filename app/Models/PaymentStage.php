<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
