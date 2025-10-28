@extends('layouts.backend.master')
@section('title')
    {{ __('titles.room.chats') }}
@endsection

@section('css')
    <style>
        /* body {
            background-color: #f4f7fa;
            font-family: 'Tahoma', sans-serif;
        } */

        .chat-list-container {
            /* max-width: 900px; */
            /* margin: 50px auto; */
        }

        .chat-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            margin-bottom: 15px;
            overflow: hidden;
        }

        .chat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .chat-card .card-body {
            display: flex;
            align-items: center;
            padding: 15px 20px;
        }

        .chat-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: linear-gradient(135deg, #007bff, #00b4d8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 26px;
            margin-left: 15px;
            flex-shrink: 0;
            position: relative;
        }

        /* الشارة الخاصة بعدد الرسائل الجديدة */
        .unread-badge {
            position: absolute;
            top: -5px;
            left: -5px;
            background: rgba(220, 53, 69, 0.9);
            /* شفاف وأنيق */
            color: #fff;
            font-size: 11px;
            border-radius: 50%;
            padding: 4px 7px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(2px);
            animation: pulse 1.2s infinite;
        }

        /* حركة خفيفة تعطي لمسة أنيقة */
        @keyframes pulse {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            50% {
                transform: scale(1.2);
                opacity: 0.8;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .chat-info {
            flex: 1;
        }

        .chat-info h5 {
            margin: 0;
            font-weight: bold;
            color: #333;
        }

        .chat-info p {
            margin: 0;
            color: #777;
            font-size: 14px;
        }

        .chat-actions a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        .chat-actions a:hover {
            text-decoration: underline;
        }

        .header-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .header-title h2 {
            font-weight: bold;
            color: #007bff;
        }

        .header-title p {
            color: #555;
        }

        .disabled {
            background-color: #bcb3b3;
        }
    </style>
@endsection

@section('content')
    <div class="chat-list-container">

        <div class="header-title">
            <h2><i class="fa fa-comments"></i> {{ __('titles.room.your_chat_rooms') }}</h2>
            <p>{{ __('titles.room.communicate') }}</p>
        </div>

        @forelse ($rooms as $room)
            <div id="room-{{ $room->id }}" class="chat-card d-block @disabled(!auth()->user()->canChat($room->tour))">
                <div class="card-body">
                    <div class="chat-avatar position-relative m-2">
                        <i class="fa fa-map-marker"></i>

                        <span class="badge badge-danger unread-badge" @class(['d-none' => $room->unread_count == 0])>
                            {{ $room->unread_count }}
                        </span>
                    </div>

                    <a href="{{ route('user.chats.show', $room->id) }}" class="chat-info text-decoration-none">
                        <div>
                            <h5 class="d-inline-block">{{ $room->tour->title }}</h5>
                            <small class="text-muted">{{ __('messages.last_message_before') }}
                                {{ $room->updated_at->diffForHumans() }}</small>
                        </div>
                        <p>
                            <i class="fa fa-users"></i>
                            {{ $room->users->count() }} {{ __('titles.room.members') }}
                        </p>
                        <small class="text-muted">
                             {{ $room->tour->end_date->diffForHumans() }}
                        </small>
                    </a>

                    <div class="chat-actions text-left">

                        {{-- @if (auth()->id() == $room->tour->guide_id)
                        <x-confirm-button :url="route('user.chat.empty',$room->id)" :buttonName="__('buttons.icon.text.empty')" 
                            method="PUT" :tooltip="__('tooltips.empty')" 
                            :modalTitle="__('modals.emptyChat')" :modalMessage="__('modals.emptyMessage')"/>
                        @endif --}}
                    </div>
                </div>
            </div>
        @empty
            <div class="alert alert-info text-center">
                <i class="fa fa-info-circle"></i>{{ __('alerts.no_available_chat_rooms') }}
            </div>
        @endforelse

    </div>
@endsection

@push('scripts')
    <script>
        const currentUser = {{ auth()->id() }};
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });

        // افترض أن لديك قائمة بكل غرف المستخدم
        const rooms = @json($rooms->pluck('id'));

        rooms.forEach(roomId => {
            const channel = pusher.subscribe('chat-room.' + roomId);

            channel.bind('message.sent', function(data) {
                const msg = data.message;
                console.log(msg);

                // تجاهل رسائل المستخدم نفسه
                if (msg.user.id === currentUser) return;

                // تحديث العداد في Sidebar
                const badge = document.querySelector(`#room-${roomId} .unread-badge`);
                if (badge) {
                    badge.innerText = parseInt(badge.innerText || '0') + 1;
                    badge.style.display = 'inline';
                }
            });

            channel.bind('MessagesRead', function(data) {
                if (data.user_id === currentUser) return; // تجاهل إذا كان الحدث من نفس المستخدم

                // تحديث العداد للآخرين
                const badge = document.querySelector(`#room-${data.room_id} .unread-badge`);
                if (badge) {
                    badge.innerText = 0; // تصفير العداد
                    badge.style.display = 'none';
                }
            });
        });

        //         const currentUser = {{ auth()->id() }};

        // rooms.forEach(roomId => {
        //     const channel = pusher.subscribe('chat-room.' + roomId);


        // });
    </script>
@endpush
