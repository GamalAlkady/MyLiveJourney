<?php

namespace App\Policies;

use App\Models\{User, ChatRoom, Booking};

class ChatRoomPolicy
{
    /**
     * التحقق من صلاحية دخول المستخدم إلى الغرفة.
     */
    public function join(User $user, ChatRoom $room): bool
    {
        return $user->canChat($room->tour);
        // $tour = $room->tour;

        // // السماح للمرشد المالك للجولة
        // if ($tour->guide_id === $user->id) {
        //     return true;
        // }

        // // السماح للمستخدم الذي لديه حجز مقبول
        // return Booking::where('tour_id', $tour->id)
        //     ->where('user_id', $user->id)
        //     ->where('status', 'accepted')
        //     ->exists();
    }
}
