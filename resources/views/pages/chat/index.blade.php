@extends('layouts.backend.master')
@section('title')
    {{ __('titles.room.chats') }}
@endsection

@section('css')
    <style>
        body {
            background-color: #f4f7fa;
            font-family: 'Tahoma', sans-serif;
        }

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
            <div class="chat-card d-block @disabled(!auth()->user()->canChat($room->tour))">
                <div class="card-body">
                    <div class="chat-avatar position-relative m-2">
                        <i class="fa fa-map-marker"></i>
                        @if ($room->unread_count > 0)
                            <span class="badge badge-danger unread-badge">
                                {{ $room->unread_count }}
                            </span>
                        @endif
                    </div>

                    <a href="{{ route('user.chats.show', $room->id) }}" class="chat-info text-decoration-none">
                            <h5>{{ $room->tour->title }}</h5>
                        <p>
                            <i class="fa fa-users"></i>
                            {{ $room->users->count() }} {{ __('titles.room.members') }}
                        </p>
                        <small class="text-muted">
                            {{ $room->tour->start_date }} - {{ $room->tour->end_date }}
                        </small>
                    </a>

                    <div class="chat-actions text-left">

                        @if (auth()->id() == $room->tour->guide_id)
                            <x-delete-button url="{{ route('user.chats.destroy', $room->id) }}" text_button="2"
                                :itemName="__('titles.chat_room')" />
                        @endif
                        {{-- <a href="{{ route('user.chats.show', $room->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fa fa-comments"></i> دخول
                    </a> --}}
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
