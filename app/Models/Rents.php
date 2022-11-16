<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rents extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_lahan',
        'done_price',
        'period',
        'period_type',
        'method',
        'agreement_photo',
        'status',
        'status_instalment'
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
