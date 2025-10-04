@extends('layouts.app')

@section('title', 'Review AI - Pakar Hukum')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Riwayat Review Chat</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    
    <div class="card shadow-sm">
        <div class="card-body">
            <table id="datatable" class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Pertanyaan User</th>
                        <th>Jawaban AI</th>
                        <th>Confidence AI</th>
                        <th>Jawaban Pakar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($chats as $chat)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $chat->user_name }}</strong><br>
                            {{ \Illuminate\Support\Str::limit($chat->user_message, 50) }}
                        </td>
                        <td>{{ \Illuminate\Support\Str::limit($chat->ai_message, 50) }}</td>
                        <td>{{ $chat->confidence }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($chat->review_message, 50) }}</td>
                        <td>
                            <button class="btn btn-sm btn-primary" 
                                data-bs-toggle="modal"
                                data-bs-target="#reviewModal"
                                data-chat-id="{{ $chat->id }}"
                                data-user-message="{{ $chat->user_message }}"
                                data-ai-message="{{ $chat->ai_message }}"
                                data-review-message="{{ $chat->review_message }}"
                                data-ai-references="{{ $chat->ai_references }}"
                                data-review-references="{{ $chat->review_references }}"
                                data-ai-confidence="{{ $chat->confidence }}"
                                >
                                Detail
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="reviewForm" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Koreksi Jawaban AI</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Pertanyaan User</label>
                    <textarea class="form-control" id="chat_message" rows="2" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label>Jawaban AI</label>
                    <textarea class="form-control" id="ai_message" rows="3" readonly></textarea>
                </div>
                <div class="mb-3">
                    <label>Referensi AI</label>
                    <textarea class="form-control" id="ai_references" name="sources" rows="2"></textarea>
                </div>
                <div class="mb-3">
                    <label>Confidence AI</label>
                    <input class="form-control" id="confidence" name="confidence">
                </div>
                <div class="mb-3">
                    <label>Jawaban Pakar</label>
                    <textarea class="form-control" id="review_message" name="answer" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Referensi Pakar</label>
                    <textarea class="form-control" id="review_references" name="reviewSources" rows="2" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let reviewModal = document.getElementById('reviewModal');
    let reviewForm = document.getElementById('reviewForm');

    reviewModal.addEventListener('show.bs.modal', function (event) {
        let button = event.relatedTarget;
        let chatId = button.getAttribute('data-chat-id');
        let userMessage = button.getAttribute('data-user-message');
        let aiMessage = button.getAttribute('data-ai-message');
        let reviewMessage = button.getAttribute('data-review-message');
        let aiConfidence = button.getAttribute('data-ai-confidence');

        let aiReferences = button.getAttribute('data-ai-references');
        let reviewReferences = button.getAttribute('data-review-references');

        document.getElementById('chat_message').value = userMessage;
        document.getElementById('ai_message').value = aiMessage;
        document.getElementById('review_message').value = reviewMessage;
        document.getElementById('ai_references').value = aiReferences;
        document.getElementById('review_references').value = reviewReferences;
        document.getElementById('confidence').value = aiConfidence;
    });
});
</script>
@endpush