<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customers extends Authenticatable
{
    use Notifiable;

    protected $guard = 'web';

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
