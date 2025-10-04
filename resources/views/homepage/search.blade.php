@extends('layouts.home')

@section('title', 'Search')

@section('content')
<div class="container py-5 px-3">
  <div class="row g-4">
    
    {{-- KONTEN UTAMA --}}
    <div class="col-lg-8">
      <p class="mb-4">
        Hasil pencarian 
        @if($query)
          untuk: <strong>{{ $query }}</strong>
        @endif
      </p>

      @if($articles->count())
        @foreach($articles as $article)
          <div class="d-flex mb-4 flex-column flex-md-row shadow-none py-2 rounded">
            <div class="flex-shrink-0 me-md-3 mb-3 mb-md-0" style="width: 200px;">
              <img src="{{ asset('storage/uploads/' . $article->thumbnail) }}" 
                   class="img-fluid rounded w-100 h-100 object-fit-cover" 
                   alt="{{ $article->title }}">
            </div>
            <div class="flex-grow-1 d-flex flex-column">
              <a href="{{ route('homepage.category', $article->category->slug ?? 'umum') }}" 
                 class="bg-primary text-white px-2 py-1 align-self-start text-decoration-none rounded mb-2" 
                 style="font-size: 12px;">
                 {{ $article->category->name ?? 'General' }}
              </a>
              <h5 class="fw-bold mb-2">
                <a href="{{ route('homepage.show', $article->slug) }}" 
                   class="text-decoration-none text-dark link-primary link-underline-primary">
                  {{ Str::limit($article->title, 80) }}
                </a>
              </h5>
              <p class="text-muted small mb-3">
                {{ Str::limit(strip_tags($article->body), 150) }}
              </p>
              <div class="mt-auto">
                <small class="text-muted">
                  {{ $article->author->display_name ?? 'Unknown' }} · 
                  {{ $article->created_at->format('d M Y') }}
                </small>
              </div>
            </div>
          </div>
        @endforeach

        <div class="mt-4">
          {{ $articles->appends(['q' => $query])->links() }}
        </div>
      @else
        <div class="alert alert-warning">
          Tidak ada hasil ditemukan untuk <strong>{{ $query }}</strong>.
        </div>
      @endif
    </div>

    {{-- SIDEBAR --}}
    <div class="col-lg-4">
      <div class="card border-0 shadow-0 mb-4" style="border-radius: 20px; overflow: hidden;">
        <div class="card-body text-center p-5 d-flex flex-column align-items-center" 
             style="background: linear-gradient(180deg, #002b49 0%, #6a0dad 100%); color: #fff;">
          <h5 class="fw-bold mb-4" style="font-size: 22px; letter-spacing: 0.5px;">
            Punya Masalah Hukum?
          </h5>
          <div class="d-flex justify-content-center align-items-center mb-4"
              style="width: 90px; height: 90px; border-radius: 50%; background: rgba(255,255,255,0.15);">
            <i class="bi bi-chat-dots" style="font-size: 42px;"></i>
          </div>
          <a href="{{ route('cases.index') }}" class="btn btn-light fw-semibold px-4 py-3 mb-3" 
             style="border-radius: 8px; font-size: 15px; color:#002b49;">
            Kirim Pertanyaan ke AI
          </a>
          <small>
            <a href="{{ route('disclaimer') }}" class="text-white-50 text-decoration-none">Baca Disclaimer</a>
          </small>
        </div>
      </div>

      <h6 class="fw-bold my-3 mt-5">ARTIKEL TERBARU</h6>
      <ul class="list-unstyled">
        @foreach($latestArticles as $latest)
        <li class="d-flex mb-3">
          <img src="{{ asset('storage/uploads/' . $latest->thumbnail) ?? 'https://picsum.photos/100/100' }}" 
              class="rounded me-2" width="100" height="80" alt="{{ $latest->title }}">
          <div>
            <a href="{{ route('homepage.show', $latest->slug) }}" 
               class="fw-semibold text-dark text-decoration-none link-primary link-underline-primary d-block">
              {{ $latest->title }}
            </a>
            <small class="text-muted">{{ $latest->created_at->format('d M Y') }}</small>
          </div>
        </li>
        @endforeach
      </ul>
    </div>

  </div>
</div>
@endsection
