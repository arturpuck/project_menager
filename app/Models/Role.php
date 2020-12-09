<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\NamesForCurrentLanguage;
use App\Casts\NameAttribute;

class Role extends Model
{
    use HasFactory, NamesForCurrentLanguage;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'name_pl'
    ];

    protected $casts = [
        'name' => NameAttribute::class,
    ];
}
