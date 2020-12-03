<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClockifyReport extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'reported_hours',
        'report_date',
        'report_file_name'
    ];

    public function getFilePathAttribute(){

        return '/reports/'.$this->report_file_name;

    }
}
