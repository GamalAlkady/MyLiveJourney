<?php

namespace App\Enums;

enum BookingStatus: string
{
    case APPROVED = 'approved';     // تمت الموافقة
    case DISAPPROVED = 'disapproved';               // تم رفضها
    case CANCELLED = 'cancelled';               // تم إلغاؤها
    case PENDING = 'pending';  // في انتظار الموافقة
}
