<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NamesForCurrentLanguage;

class ProjectReportStatus extends Model
{
    use HasFactory, NamesForCurrentLanguage;

    public $timestamps = false;
    protected $fillable = ['name', 'name_pl'];
    protected $appends = ['name_in_current_language'];

}
