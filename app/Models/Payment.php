<?php

namespace App\Models;

use App\Enums\MerchantPaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class)->using(MerchantPayment::class);
    }
}
