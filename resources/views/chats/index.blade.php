@extends('layouts.app')

@section('title', 'Chat Case')

@section('content')
<div class="d-flex flex-column" style="height: calc(100vh - 60px); background-color: #f9fafb;">

    {{-- Header --}}
    <div class="px-4 py-2 border-bottom bg-white shadow-sm">
        <h6 class="m-0 fw-semibold">💬 Case: {{ $case->title }}</h6>
    </div>

    {{-- Chat Area --}}
    <div id="chatBox" class="flex-grow-1 overflow-auto px-4 py-3 bg-white">
        @forelse($chats as $chat)
            <div class="d-flex mb-4 {{ $chat->role === 'user' ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="chat-bubble {{ $chat->role }} {{ ($chat->role === 'ai' && $chat->status === 'approved') ? 'reviewed' : '' }}">

                    {{-- Label role --}}
                    @if($chat->role === 'ai')
                        <div class="fw-semibold small text-secondary mb-1">
                            AI Assistant
                            @if($chat->status === 'approved')
                                <span class="badge bg-success ms-2">Reviewed Expert</span>
                            @elseif($chat->status === 'need_review')
                                <span class="badge bg-warning text-dark ms-2">Perlu Review</span>
                            @endif
                        </div>
                    @elseif($chat->role === 'expert')
                        <div class="fw-semibold small text-secondary mb-1">{{ $chat->user->name }} <span class="badge bg-success ms-2">Expert</span></div>
                    @endif

                    {{-- Pesan --}}
                    @php
                        $conf = $chat->metadata['confidence'] ?? null;
                    @endphp

                    @if($chat->role === 'ai' && $conf !== null && $conf > 0 && $conf < 0.7)
                        <em>Mohon maaf, saat ini AI belum memiliki jawaban. Silakan ajukan pertanyaan lain atau coba lagi nanti.</em>
                    @else
                        <div>{!! nl2br(e($chat->message)) !!}</div>
                    @endif

                    {{-- Metadata: waktu & confidence --}}
                    <div class="small text-muted mt-2 d-flex justify-content-between">
                        <span>{{ $chat->created_at->format('H:i') }}</span>
                        @if($chat->role === 'ai' && isset($conf) && $conf != null)
                            @php
                                $confLabel = $conf < 0.5 ? 'Rendah' : ($conf < 0.7 ? 'Sedang' : 'Tinggi');
                            @endphp
                            <span class="ms-2">Confidence: {{ number_format($conf * 100, 1) }}% ({{ $confLabel }})</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center text-muted">💡 Belum ada percakapan. Mulai dengan mengetik pesan.</div>
        @endforelse

    </div>

    {{-- Input Box --}}
    <div class="p-3 border-top bg-white">
        <form action="{{ route('chats.store', $case->id) }}" method="POST" class="d-flex">
            @csrf
            <textarea name="message" class="form-control border-0 rounded-pill shadow-sm me-2 px-3 py-2" rows="1"
                placeholder="Ketik pesan..." required style="resize: none;"></textarea>
            <button type="submit" class="btn btn-success rounded-pill px-4">➤</button>
        </form>
        <div class="form-text text-muted small mt-2">
            AI dapat memberikan jawaban otomatis. Pastikan memeriksa ulang jika confidence rendah.
        </div>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chatBox');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

<style>
    .chat-bubble {
        max-width: 70%;
        padding: 14px 18px;
        border-radius: 12px;
        font-size: 0.95rem;
        line-height: 1.5;
        word-break: break-word;
        border: 1px solid #e5e7eb;
    }

    .chat-bubble.ai {
        background: #ffffff;
        border: 1px solid #e5e7eb;
        color: #111827;
    }

    .chat-bubble.expert {
        border: 1px solid;
        border-color: #22c55e;
        background: #f0fdf4;
        color: #111827;
    }

    /* Warna berbeda jika sudah direview expert */
    .chat-bubble.ai.reviewed {
        border-color: #22c55e;
        background: #fff;
    }

    .chat-bubble .badge {
        font-size: 0.6rem;
    }

    textarea:focus {
        box-shadow: none !important;
    }
</style>
@endsection
