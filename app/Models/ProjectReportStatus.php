<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\NameAttribute;

class ProjectReportStatus extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name', 'name_pl'];

    protected $casts = [
        'name' => NameAttribute::class,
    ];
}
