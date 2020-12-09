<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NamesForCurrentLanguage;
use App\Casts\NameAttribute;

class ProjectStatus extends Model
{
    use HasFactory, NamesForCurrentLanguage;

  protected  $fillable = [
      'name',
      'name_pl'
  ];

  public $timestamps = false;
  protected $table = 'project_statuses';

  protected $casts = [
    'name' => NameAttribute::class,
];

}
