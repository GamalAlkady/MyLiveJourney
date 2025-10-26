<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = auth()->user()->myChatRooms()->withUnreadCount()->get();

        // foreach ($rooms as $room) {
        //     $pivot = $room->users->find(auth()->id())?->pivot;
        //     $lastRead = $pivot?->last_read_at;
        //     $room->unreadCount = $room->messages()
        //         ->when($lastRead, fn ($q) => $q->where('created_at', '>', $lastRead))
        //         ->count();
        // }

        // return $rooms->first()->unread_count;
        return view('pages.chat.index', compact('rooms'));
    }

    /**
     * Show the chat room with messages.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(ChatRoom $room)
    {
        $user = auth()->user();
        $this->authorize('join', $room);

        $messages = $room->messages()->with('user')->get();

        $user->chatRooms()->updateExistingPivot($room->id, [
            'last_read_at' => now(),
        ]);

        return view('pages.chat.room', compact('room', 'messages'));
    }

    public function sendMessage(Request $request, ChatRoom $room)
    {
        $message = $room->messages()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['message' => $message]);
    }
}
