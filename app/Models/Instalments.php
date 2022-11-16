<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instalments extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_user',
        'id_lahan',
        'id_rent',
        'month',
        'amount',
        'proof_of_payment',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(Customers::class, 'id_user');
    }

    public function ads()
    {
        return $this->belongsTo(Ads::class, 'id_lahan');
    }

    public function rent()
    {
        return $this->belongsTo(Rents::class, 'id_rent');
    }
}
