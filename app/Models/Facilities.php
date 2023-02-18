<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_ads',
        'land',
        'road',
        'view',
        'range',
        'height',
        'temperature',
    ];
}
