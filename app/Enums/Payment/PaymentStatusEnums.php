<?php

namespace App\Enums\Payment;

use App\Traits\{EnumOptions, EnumValues};

enum PaymentStatusEnums: string
{
    use EnumValues;
    use EnumOptions;
    case PENDING    = 'pending';
    case APPROVED   = 'approved';
    case REJECTED       = 'rejected';
}
