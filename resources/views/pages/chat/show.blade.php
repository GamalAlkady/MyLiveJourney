@extends('layouts.backend.master')
@section('title')
    {{ __('titles.chat_room') }}
@endsection

@section('css')
    {{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> --}}
    <style>
        /* body {
                                            background-color: #f8f9fa;
                                            font-family: 'Tahoma', sans-serif;
                                        } */

        .chat-container {
            max-width: 90%;
            margin: -10px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 80vh;
        }

        .chat-header {
            background: #007bff;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .chat-header h5 {
            margin: 0;
            font-size: 18px;
        }

        .chat-body {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
            background: #f5f5f5;
        }

        .message {
            margin-bottom: 15px;
            display: flex;
        }

        .message .bubble {
            padding: 10px 15px;
            border-radius: 20px;
            max-width: 70%;
            word-wrap: break-word;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .message.you {
            justify-content: flex-start;
        }

        .message.you .bubble {
            background: #fff;
            border: 1px solid #ddd;
        }

        .message.me {
            justify-content: flex-end;
        }

        .message.me .bubble {
            background: #007bff;
            color: #fff;
        }

        .chat-footer {
            background: #fff;
            border-top: 1px solid #ddd;
            padding: 10px;
            display: flex;
            align-items: center;
        }

        .chat-footer input {
            flex: 1;
            border: none;
            padding: 10px 15px;
            border-radius: 20px;
            outline: none;
            background: #f1f1f1;
        }


        .chat-footer button:hover {
            background: #0056b3;
        }

        /* Scrollbar */
        .chat-body::-webkit-scrollbar {
            width: 6px;
        }

        .chat-body::-webkit-scrollbar-thumb {
            background: #ccc;
            border-radius: 3px;
        }
    </style>
@endsection

@section('content')
    {{-- <h2> {{ $room->guide->name }}: {{ $room->name }}</h2> --}}

    <div class="chat-container">
        <!-- Header -->
        <div class="chat-header">
            <div>
                <i class="fa fa-user-circle"></i>
                <h5 class="d-inline-block ml-2">{{ $room->guide->name }}</h5>
                - <span> {{ $room->tour->title }}</span>
            </div>
            @if (auth()->id() == $room->tour->guide_id)
                <div>
                    <x-confirm-button :url="route('user.chat.empty', $room->id)" 
                        btnTextColor="text-white" :disabled="$room->messages->count() == 0"
                        :buttonName="__('buttons.clear')" modalClass="outline-danger" method="POST"
                        :tooltip="__('tooltips.emptyChat')" :modalTitle="__('modals.emptyChat')"
                        :modalMessage="__('modals.emptyMessage')" />
                </div>
            @endif


        </div>

        <!-- Messages -->
        <div class="chat-body" id="chat-body">
            @foreach ($messages as $msg)
                <div class="message {{ $msg->user_id == auth()->id() ? 'me' : 'you' }}">
                    <div class="bubble">
                        <span class="text-black">{{ $msg->user->name }}</span><br>
                        {{ $msg->content }}
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Footer -->
        <div class="chat-footer">
            <input type="text" id="content" placeholder="{{ __('forms.placeholders.write_something') }}"
                autocomplete="off">
            <button id="send-btn" class="btn btn-primary rounded-circle disabled">
                <i class="fa fa-paper-plane"></i>
                <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"
                    style="width: 18px; height: 18px;"></span>
            </button>
            </button>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
        });
        const channel = pusher.subscribe('chat-room.{{ $room->id }}');

        channel.bind('message.sent', function(data) {
            const msg = data.message;
            const currentUser = {{ auth()->id() }};
            const position = msg.user.id === currentUser ? 'me' : 'you';

            const messageDiv = `
                                    <div class="message ${position}">
                                        <div class="bubble">
                                            <span class="text-black">${msg.user.name}</span><br>
                                            ${msg.content}
                                        </div>
                                    </div>
                                `;
            document.getElementById('chat-body').insertAdjacentHTML('beforeend', messageDiv);
            scrollToBottom();
        });


        function scrollToBottom() {
            const chatBody = document.getElementById('chat-body');
            chatBody.scrollTop = chatBody.scrollHeight;
        }

        document.getElementById('send-btn').addEventListener('click', sendMessage);
        $('#content').on('input', function() {
            const content = $(this).val().trim();
            $('#send-btn').toggleClass('disabled', !content);
        });

        document.getElementById('content').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') sendMessage();
        });

        async function sendMessage() {
            const content = document.getElementById('content').value.trim();
            if (!content) return;

            $('#send-btn').addClass('disabled');
            $('#send-btn i').addClass('d-none');
            $('#send-btn #loading-spinner').removeClass('d-none');

            await fetch('{{ route('user.chat.send', $room) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    content
                })
            });

            document.getElementById('content').value = '';
            $('#send-btn i').removeClass('d-none');
            $('#send-btn #loading-spinner').addClass('d-none');
            scrollToBottom();
        }

        scrollToBottom();
    </script>
@endpush
