@extends('layouts.app')

<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    .chatbot-sidebar {
        position: fixed;
        right: 0;
        top: 0;
        width: 300px;
        height: 100%;
        background-color: #f1f1f1;
        border-left: 1px solid #ccc;
        box-shadow: -2px 0 5px rgba(0,0,0,0.1);
        display: none;
        flex-direction: column;
    }
    .chatbot-header {
        background-color: #007bff;
        color: white;
        padding: 10px;
        text-align: center;
        cursor: pointer;
    }
    .chatbot-content {
        flex: 1;
        padding: 10px;
        overflow-y: auto;
    }
    .chatbot-input {
        display: flex;
        border-top: 1px solid #ccc;
    }
    .chatbot-input input {
        flex: 1;
        padding: 10px;
        border: none;
        outline: none;
    }
    .chatbot-input button {
        padding: 10px;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }
    .chatbot-input button:hover {
        background-color: #0056b3;
    }
    .chat-message {
        margin: 10px 0;
    }
    .chat-message.user {
        text-align: right;
    }
    .chat-message.bot {
        text-align: left;
    }
    .toggle-chatbot {
        position: fixed;
        right: 10px;
        bottom: 10px;
        background-color: #007bff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .toggle-chatbot:hover {
        background-color: #0056b3;
    }
</style>

@section('content')
<button class="btn float-start" data-bs-toggle="offcanvas" data-bs-target="#offcanvas" role="button">
    <i class="bi bi-arrow-right-square-fill fs-3" data-bs-toggle="offcanvas" data-bs-target="#offcanvas2"></i>
</button>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{__('Notification')}}</div>
                <div class="card-body ">
                    @forelse($notifications as $notification)
                        <div class="alert alert-success" role="alert">
                            [{{ $notification->created_at }}] {{ $notification->data['message'] }}
                            <a href="{{url('/markasread')}}" class="float-right mark-as-read" data-id="{{ $notification->id }}">Mark as read</a>
                        </div>
                        @if($loop->last)
                            <a href="{{url('/markasread')}}" id="mark-all">Mark all as read</a>
                        @endif
                        @empty
                            There are no new notifications
                    @endforelse   
                </div>
            </div>
        </div>
    </div>
</div>
<button class="toggle-chatbot" onclick="toggleChatbot()">Chat with us</button>
<div class="chatbot-sidebar" id="chatbotSidebar">
        <div class="chatbot-header" onclick="toggleChatbot()">
            Chatbot
        </div>
        <div class="chatbot-content" id="chat-box">
            <!-- Chat messages will appear here -->
        </div>
        <div class="chatbot-input">
            <input type="text" id="user-input" placeholder="Type your message here...">
            <button onclick="sendMessage()">Send</button>
        </div>
    </div>
@endsection
@section('bottom-js')
<script>
        function toggleChatbot() {
            const chatbotSidebar = document.getElementById('chatbotSidebar');
            chatbotSidebar.style.display = chatbotSidebar.style.display === 'block' ? 'none' : 'block';
        }

        function sendMessage() {
            const userMessage = $('#user-input').val();

            if (userMessage.trim() === '') {
                return;
            }

            $('#chat-box').append('<div class="chat-message user">User: ' + userMessage + '</div>');

            $.ajax({
                url: '/chatbot',
                method: 'POST',
                data: {
                    message: userMessage,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#chat-box').append('<div class="chat-message bot">Bot: ' + response.response + '</div>');
                    $('#user-input').val('');
                    $('#chat-box').scrollTop($('#chat-box')[0].scrollHeight);
                }
            });
        }

        $(document).ready(function() {
            $('#user-input').on('keypress', function(e) {
                if (e.which == 13) {
                    sendMessage();
                }
            });
        });
    </script>
@endsection