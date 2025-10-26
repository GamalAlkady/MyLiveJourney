<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'guide_id', 'tour_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'chat_room_user')
            ->withPivot('last_read_at')
            ->withTimestamps();
    }

    /**
     * Get all the messages for the chat room.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages()
    {
        return $this->hasMany(ChatMessage::class);
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tour_id');
    }

    /**
     * ************************************************************************ Scopes
     */
    public function scopeWithUnreadCount($query)
    {
        $userId = Auth::id();

       return $query->withCount(['messages as unread_count' => function ($q) use ($userId) {
            $q->where('user_id', '!=', $userId) // استبعاد رسائل المستخدم نفسه
                ->whereNotIn('chat_messages.id', function ($sub) use ($userId) {
                    $sub->select('m2.id')
                        ->from('chat_messages as m2')
                        ->join('chat_room_user as cru', 'cru.chat_room_id', '=', 'm2.chat_room_id')
                        ->whereColumn('m2.created_at', '<=', 'cru.last_read_at')
                        ->where('cru.user_id', $userId);
                });
        }]);
    }
}
