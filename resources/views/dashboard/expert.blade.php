@extends('layouts.app')

@section('title', 'Dashboard Pakar')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Dashboard Pakar</h3>

    {{-- Statistik ringkasan --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Chat</h6>
                    <h3 class="fw-bold">{{ $totalChats }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Chat AI</h6>
                    <h3 class="fw-bold">{{ $totalAIChats }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Jawaban Pakar</h6>
                    <h3 class="fw-bold">{{ $totalExpertChats }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Pertanyaan User</h6>
                    <h3 class="fw-bold">{{ $totalUserChats }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            {{-- Chart Status AI Chat --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">📊 Status Jawaban AI</h6>
                    <canvas id="aiStatusChart" height="120"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            {{-- Daftar Chat AI Terbaru --}}
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">💬 Chat AI Terbaru</h6>
                    <ul class="list-group list-group-flush">
                        @foreach($latestAIChats as $chat)
                            <li class="list-group-item">
                                <strong>{{ $chat->case->title ?? 'No Case' }}</strong>
                                <br>
                                <small>oleh: {{ $chat->user->name ?? '-' }}</small>
                                <p class="mb-0">{{ \Illuminate\Support\Str::limit($chat->message, 80) }}</p>
                                <small>Status: {{ $chat->status }}, Confidence: {{ $chat->metadata['confidence'] ?? '-' }}</small>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('aiStatusChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Auto', 'Need Review', 'Approved'],
            datasets: [{
                label: 'Status AI Chat',
                data: [
                    {{ $aiStatusCounts['auto'] }},
                    {{ $aiStatusCounts['need_review'] }},
                    {{ $aiStatusCounts['approved'] }}
                ],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(75, 192, 192, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true
        }
    });
});
</script>
@endsection
