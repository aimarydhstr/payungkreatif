@extends('layouts.app')

@section('title', 'Review AI - Pakar Hukum')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Review Chat AI</h3>

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
                        <th>Confidence</th>
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
                        <td>
                            <button class="btn btn-sm btn-primary" 
                                data-bs-toggle="modal"
                                data-bs-target="#reviewModal"
                                data-chat-id="{{ $chat->id }}"
                                data-user-message="{{ $chat->user_message }}">
                                Beri Jawaban
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
                    <label>Jawaban Pakar</label>
                    <textarea class="form-control" name="answer" rows="3" required></textarea>
                </div>
                <div class="mb-3">
                    <label>Sumber / Referensi</label>
                    <textarea class="form-control" name="sources" rows="2"></textarea>
                </div>
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="add_to_kb" value="1" id="add_to_kb">
                    <label class="form-check-label" for="add_to_kb">
                        Tambahkan ke Knowledge Base
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-success">Simpan Jawaban</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var reviewModal = document.getElementById('reviewModal');
    var reviewForm = document.getElementById('reviewForm');

    reviewModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var chatId = button.getAttribute('data-chat-id');
        var userMessage = button.getAttribute('data-user-message');

        reviewForm.action = '/expert/reviews/' + chatId;
        document.getElementById('chat_message').value = userMessage;
    });
});
</script>
@endpush
