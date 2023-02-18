<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_lahan',
        'survey_date'
    ];

    public function user()
    {
        return $this->belongsTo(Customers::class, 'id_user');
    }

    public function ads()
    {
        return $this->belongsTo(Ads::class, 'id_lahan');
    }
    
}
