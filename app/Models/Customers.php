<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'address',
        'phone',
        'work',
        'password',
        'profile_picture',
    ];
}
