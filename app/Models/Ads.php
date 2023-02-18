<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_category',
        'title',
        'address',
        'large',
        'certification',
        'desc',
        'price',
        'period',
        'status', // 0 tersedia, 1 tersewa
        'condition',
        'is_irigation',
        'irigation',
        // 'land',
        // 'road',
        // 'view',
        // 'range',
        // 'temperature',
        // 'height',
        'notice',
        'picture_one',
        'picture_two',
        'picture_three',
        'picture_four',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(Customers::class, 'id_user');
    }

    public function categories()
    {
        return $this->belongsTo(Categories::class, 'id_category');
    }
}
