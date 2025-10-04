@extends('layouts.app')

@section('title', 'Chat dengan Expert')

@section('content')
<div class="d-flex flex-column" style="height: calc(100vh - 60px); background-color: #f9fafb;">

    <div class="px-4 py-2 border-bottom bg-white shadow-sm">
        <h6 class="m-0 fw-semibold">💬 Chat dengan {{ $user->name }}</h6>
    </div>

    <div id="chatBox" class="flex-grow-1 overflow-auto px-4 py-3 bg-white">
        @forelse($chats as $chat)
            @php
                $isSender = $chat->user_id === Auth::id();
            @endphp

            <div class="d-flex mb-3 {{ $isSender ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="chat-bubble {{ $isSender ? 'me' : 'other' }}">
                    <strong>{{ $isSender ? 'Anda' : $chat->user->name }}</strong><br>
                    {!! nl2br(e($chat->message)) !!}
                    <div class="small text-muted mt-1">{{ $chat->created_at->format('H:i') }}</div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">💡 Belum ada percakapan. Mulai dengan mengetik pesan.</div>
        @endforelse
    </div>

    <div class="p-3 border-top bg-white">
        <form action="{{ Auth::user()->role === 'user' ? route('consult-chat.store', $user->id) : route('expert.consult-chat.store', $user->id) }}" method="POST" class="d-flex">
            @csrf
            <textarea name="message" class="form-control border-0 rounded-pill shadow-sm me-2 px-3 py-2" rows="1"
                placeholder="Ketik pesan..." required style="resize: none;"></textarea>
            <button type="submit" class="btn btn-success rounded-pill px-4">➤</button>
        </form>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

<style>
    .chat-bubble {
        max-width: 70%;
        min-width: 220px;
        padding: 12px 16px;
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.4;
        word-break: break-word;
        border: 1px solid #e5e7eb;
    }

    .chat-bubble.me {
        background: #c3f6d5ff;
        color: #111827;
    }

    .chat-bubble.other {
        background: #e5e7eb;
        color: #111827;
    }

    textarea:focus {
        box-shadow: none !important;
    }
</style>
@endsection
