<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'name',
        'gender',
        'age',
        'company',
        'year',
        'month',
        'day',
        'county',
        'registration_code',
        'control_code',
    ];
}
