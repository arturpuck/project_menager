<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_phone_number',
        'email',
        'address',
        'tax_identification_number',
        'contact_person_name'
    ];
}
