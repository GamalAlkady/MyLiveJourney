<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\MessagesRead;
use App\Models\ChatRoom;
use Illuminate\Http\Request;

class ChatRoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = auth()->user()->myChatRooms()->withUnreadCount()->get();

        // return $rooms->first()->unread_count;
        return view('pages.chat.index', compact('rooms'));
    }



    public function show(ChatRoom $room)
    {
        $user = auth()->user();
        $this->authorize('join', $room);

        $messages = $room->messages()->with('user')->get();

        $user->chatRooms()->updateExistingPivot($room->id, [
            'last_read_at' => now(),
        ]);

        // إرسال الحدث لبقية المتصلين
        broadcast(new MessagesRead($room->id, $user->id))->toOthers();

        return view('pages.chat.show', compact('room', 'messages'));
    }

    public function sendMessage(Request $request, ChatRoom $room)
    {
        $message = $room->messages()->create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json(['status' => 'Message Sent']);
    }

    public function empty(ChatRoom $room)
    {
        // dd($room);
        $message = $room->messages()->delete();

        // broadcast(new MessageSent($message))->toOthers();

        return back();
    }
}
