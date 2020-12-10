<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NamesForCurrentLanguage;

class ProjectStatus extends Model
{
    use HasFactory, NamesForCurrentLanguage;

  protected  $fillable = [
      'name',
      'name_pl'
  ];

  public $timestamps = false;
  protected $table = 'project_statuses';
  protected $appends = ['name_in_current_language'];

}
