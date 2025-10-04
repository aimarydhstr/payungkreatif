@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
    <h2 class="mb-2">Dashboard</h2>
    <p class="text-muted mb-4">Ringkasan statistik dan aktivitas terbaru di sistem.</p>

    {{-- Statistik ringkasan --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Pengguna</h6>
                    <h3 class="fw-bold">{{ $usersCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Artikel</h6>
                    <h3 class="fw-bold">{{ $articlesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Kategori</h6>
                    <h3 class="fw-bold">{{ $categoriesCount }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Tag</h6>
                    <h3 class="fw-bold">{{ $tagsCount }}</h3>
                </div>
            </div>
        </div>
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

    {{-- Grafik --}}
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <h6 class="fw-semibold mb-3">📊 Distribusi Artikel per Kategori</h6>
            <canvas id="articlesChart" height="120"></canvas>
        </div>
    </div>

    {{-- Daftar terakhir --}}
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">🧑‍💼 Pengguna Terbaru</h6>
                    @if($latestUsers->count())
                        <ul class="list-group list-group-flush">
                            @foreach($latestUsers as $user)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $user->name }} <span class="badge bg-primary">{{ ucfirst($user->role) }}</span></strong> 
                                        <div class="text-muted small">{{ $user->email }}</div>
                                    </div>
                                    
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada pengguna baru.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h6 class="fw-semibold mb-3">📰 Artikel Terbaru</h6>
                    @if($latestArticles->count())
                        <ul class="list-group list-group-flush">
                            @foreach($latestArticles as $article)
                                <li class="list-group-item d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $article->title }}</strong>
                                        <div class="text-muted small">{{ $article->author->display_name ?? 'Tanpa Penulis' }} · {{ $article->created_at->format('d M Y') }}</div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-muted">Belum ada artikel baru.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('articlesChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($categories->pluck('name')),
            datasets: [{
                label: 'Jumlah Artikel',
                data: @json($categories->pluck('articles_count')),
                backgroundColor: '#3b82f6',
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.parsed.y} Artikel`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        precision: 0, // pastikan angka bulat
                        stepSize: 1   // increment 1
                    },
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Artikel'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Kategori'
                    }
                }
            }
        }
    });
</script>
@endsection
