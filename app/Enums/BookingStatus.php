<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Approved = 'approved';     // تمت الموافقة
    case Rejected = 'rejected';               // تم رفضها
    case Cancelled = 'cancelled';               // تم إلغاؤها
    case Pending = 'pending';  // في انتظار الموافقة
}
