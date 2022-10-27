<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppPayment extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class);
    }
}
