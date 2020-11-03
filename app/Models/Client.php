<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name_contact_person',
        'email',
        'phone_number',
        'company_name',
        'tax_identification_number'
    ];
}