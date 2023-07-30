<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    use HasFactory;

    protected $table = 'facilities';

    protected $fillable = [
        'id_ads',
        'land',
        'road',
        'view',
        'range',
        'height',
        'temperature',
    ];

    public function ad()
    {
        // Assuming the foreign key is "id_ads" in the "facility" table
        return $this->belongsTo(Ads::class, 'id_ads');
    }
}
