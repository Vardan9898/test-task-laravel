<?php

namespace App\Enums;

enum MerchantPaymentStatus: string
{
    case New = 'new';
    case Pending = 'pending';
    case Completed = 'completed';
    case Expired = 'expired';
    case Rejected = 'rejected';
}
