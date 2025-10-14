<?php

namespace App\Enums;

enum TourStatus: string
{
    case Available = 'available';     // مفتوحة للحجز
    case Full = 'full';               // اكتملت المقاعد
    case InProgress = 'in_progress';  // قيد التنفيذ
    case Completed = 'completed';     // منتهية
    case Cancelled = 'cancelled';     // ألغيت من المرشد أو الإدارة
}
