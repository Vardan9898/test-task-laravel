<?php

namespace App\Enums;

enum MerchantAppPaymentStatus: string
{
    case Created = 'created';
    case InProgress = 'inprogress';
    case Paid = 'paid';
    case Expired = 'expired';
    case Rejected = 'rejected';
}
