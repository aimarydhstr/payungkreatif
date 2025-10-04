@extends('layouts.home')
@section('title', 'Beranda')
@section('content')

<style>
  .mini-item {
    flex: 1 1 100%!important; 
    max-width: 100%!important;
  }

  .thumb-wrapper {
    width: 100%!important;
    height: 140px!important; 
    border-radius: 6px!important;
  }

  .thumb-wrapper img {
    width: 100%!important;
    height: 100%!important;
    object-fit: cover!important; 
    display: block!important;
  }
  .pusat-section img {
    width:100%; max-width:200px; min-width:200px; height:140px;
  }

  /* tablet: 2 kolom */
  @media (min-width: 480px) {
    .mini-item {
      flex: 1 1 calc(50% - 0.5rem)!important;
      max-width: calc(50% - 0.5rem)!important;
    }
    .pusat-section img {
      min-width: 150px;
      max-width: 150px;
    }
  }

  /* desktop: 4 kolom */
  @media (min-width: 992px) {
    .mini-item {
      flex: 1 1 calc(25% - 0.5rem)!important;
      max-width: calc(25% - 0.5rem)!important;
    }
  }
</style>

<div class="row gx-4">
  <!-- left hero -->
  <div class="col-lg-8">
    <div class="position-relative">
      <div id="heroCarousel" class="carousel slide hero-card" data-bs-ride="carousel">
        <div class="carousel-inner hero-carousel position-relative">
          @foreach($heroArticles as $key => $article)
          <div class="carousel-item {{ $key == 0 ? 'active' : '' }} position-relative">
            <a href="{{ route('homepage.show', $article->slug) }}">
              <img src="{{ asset('storage/uploads/' . $article->thumbnail) }}" class="d-block w-100 img-fluid" alt="{{ $article->title }}">
            </a>
            <div class="hero-overlay">
              <div class="hero-caption">
                <div class="kategory">{{ $article->category->name ?? 'Umum' }}</div>
                <h2>
                  <a href="{{ route('homepage.show', $article->slug) }}" class="text-white text-decoration-none">
                    {{ $article->title }}
                  </a>
                </h2>
                <p style="max-width:70%; color: rgba(255,255,255,0.95);">
                  {!! Str::limit(strip_tags($article->body), 150) !!}
                </p>
                <div class="mt-3">
                  <a href="{{ route('homepage.show', $article->slug) }}" class="btn" style="background:var(--accent); color:#062c42; font-weight:700; border-radius:8px;">Selengkapnya ➜</a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>

        <!-- controls -->
        <div class="carousel-controls-wrapper">
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
              <span class="bi bi-chevron-right" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
              <span class="bi bi-chevron-left" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
        </div>
      </div>

      <!-- mini thumbnails below hero -->
      <div class="d-flex flex-wrap gap-2 mt-3 mini-thumbs">
          @foreach($miniArticles as $mini)
            <div class="flex-fill mini-item {{ $loop->index == 3 ? 'd-block' : '' }}">
              <a href="{{ route('homepage.show', $mini->slug) }}" class="d-block h-100 text-decoration-none">
                <div class="thumb-wrapper position-relative overflow-hidden">
                  <img src="{{ asset('storage/uploads/' . $mini->thumbnail) }}" 
                      alt="{{ $mini->title }}" height="120" width="100%">
                </div>
                <div class="caption small mt-2 text-dark">{{ Str::limit($mini->title, 40) }}</div>
              </a>
            </div>
          @endforeach
      </div>
    </div>
  </div>

  <!-- right sidebar -->
  <aside class="col-lg-4 mt-4 mt-lg-0">
    @if($latestArticles->first())
    <div class="latest-card mb-3">
      <div class="row g-2">
        <div class="col-4">
          <a href="{{ route('homepage.show', $latestArticles->first()->slug) }}">
            <img src="{{ asset('storage/uploads/' . $latestArticles->first()->thumbnail) }}" class="small-thumb img-fluid" alt="{{ $latestArticles->first()->title }}">
          </a>
        </div>
        <div class="col-8 position-relative">
          <div style="font-size:.82rem;color:#4b6b77;font-weight:700;">
            {{ $latestArticles->first()->category->name ?? 'Update' }}
            <span class="badge bg-warning text-dark ms-1">New</span>
          </div>
          <h6 style="margin-top:6px;font-weight:800;color:#062c42;">
            <a href="{{ route('homepage.show', $latestArticles->first()->slug) }}" class="text-dark text-decoration-none">
              {{ $latestArticles->first()->title }}
            </a>
          </h6>
        </div>
      </div>
    </div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-2">
      <h4 style="margin:0;font-weight:800;">Terbaru</h4>
      <div style="color:#8aa8b2;font-size:.88rem;">{{ now()->format('d M Y') }}</div>
    </div>

    <ul class="latest-list mb-3">
      @foreach($latestArticles->skip(1)->take(4) as $article)
      <li>
        <div class="title">
          <a href="{{ route('homepage.show', $article->slug) }}" class="text-dark text-decoration-none">
            {{ $article->title }}
          </a>
        </div>
        <div class="meta">{{ $article->created_at->format('d M Y') }} · {{ $article->category->name ?? 'Umum' }}</div>
      </li>
      @endforeach
    </ul>
  </aside>
</div>

<!-- Premium Section -->
<section class="premium-section container mt-5">
  <div class="text-center mb-4">
    <h2>Premium Stories</h2>
    <p>Temukan artikel hukum komprehensif dari Payung Kreatif!</p>
  </div>

  <div class="row g-4">
    <!-- Card besar kiri -->
    @if($premiumArticles->first())
    <div class="col-lg-6">
      <a href="{{ route('homepage.show', $premiumArticles->first()->slug) }}" class="text-decoration-none">
        <div class="card-hero" style="background-image: url('{{ asset('storage/uploads/' . $premiumArticles->first()->thumbnail) }}');">
          <div class="overlay">
            <div class="date">{{ $premiumArticles->first()->created_at->translatedFormat('l, d F Y') }}</div>
            <h5 style="color:#fff;">{{ $premiumArticles->first()->title }}</h5>
            <div class="author">
              <img src="https://i.pravatar.cc/28?u={{ $premiumArticles->first()->author->id }}" alt="author">
              {{ $premiumArticles->first()->author->display_name ?? 'Anonim' }}
            </div>
          </div>
        </div>
      </a>
    </div>
    @endif

    <!-- Dua card kecil kanan -->
    <div class="col-lg-6 d-flex flex-column">
      @foreach($premiumArticles->skip(1)->take(2) as $article)
      <div class="card-small mb-2">
        <a href="{{ route('homepage.show', $article->slug) }}">
          <img src="{{ asset('storage/uploads/' . $article->thumbnail) }}" class="img-fluid" alt="{{ $article->title }}">
        </a>
        <div class="content">
          <div class="meta">{{ $article->created_at->format('d M Y') }}</div>
          <h6>
            <a href="{{ route('homepage.show', $article->slug) }}" class="text-dark text-decoration-none">{{ $article->title }}</a>
          </h6>
          <div class="author mt-1">
            <img src="https://i.pravatar.cc/28?u={{ $article->author->id }}" width="20" height="20" alt="author"> {{ $article->author->display_name ?? 'Anonim' }}
          </div>
        </div>
      </div>
      <hr>
      @endforeach
    </div>
  </div>

  <div class="text-center">
    <a href="{{ route('homepage') }}" class="btn-see-all">Lihat Semua</a>
  </div>
</section>

<!-- sections below: Pusat Data & Legal Analysis -->
<div class="row mt-5 gx-4 pusat-section">
  <div class="col-lg-8">
    <div class="d-flex justify-content-between align-items-start mb-3">
      <div>
        <div class="section-title">Pusat Data</div>
        <div style="height:3px;width:60px;background:#0a5d72;border-radius:3px;margin-top:-8px;"></div>
      </div>
      <a href="{{ route('homepage') }}" style="color:#0a5d72;font-weight:700;">SELENGKAPNYA ➜</a>
    </div>

    <div>
      @foreach($catArticles as $article)
      <div class="d-flex mb-4">
        <div class="card-small">
          <a href="{{ route('homepage.show', $article->slug) }}">
            <img src="{{ asset('storage/uploads/' . $article->thumbnail) }}" alt="{{ $article->title }}">
          </a>
          <div class="content px-2 d-flex flex-column justify-content-between h-100">
            <div>
              <div class="badge mb-2 text-bg-primary">{{ $article->category->name ?? 'Umum' }}</div>
              <h5 class="card-title fw-bold">
                <a href="{{ route('homepage.show', $article->slug) }}" class="text-dark text-decoration-none">
                  {{ $article->title }}
                </a>
              </h5>
            </div>
            <small class="text-secondary">
              Oleh {{ $article->author->display_name ?? 'Anonim' }} · {{ $article->created_at->format('d M Y') }}
            </small>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <div class="col-lg-4 mt-4 mt-lg-0">
    <div class="section-title">Legal Analysis</div>
    <div style="height:3px;width:60px;background:#0a5d72;border-radius:3px;margin-top:-8px;"></div>
    <ul class="latest-list mb-3">
      @foreach($sideArticles as $article)
      <li>
        <div class="title">
          <a href="{{ route('homepage.show', $article->slug) }}" class="text-dark text-decoration-none">
            {{ $article->title }}
          </a>
        </div>
        <div class="meta">
          {{ $article->created_at->format('d M Y') }} · {{ $article->category->name ?? 'Umum' }}
        </div>
      </li>
      @endforeach
    </ul>
  </div>
</div>

<section class="hero d-flex flex-column flex-lg-row align-items-start justify-content-between mt-5">
  <div class="hero-text me-lg-5">
    <span class="badge">Payung Kreatif AI</span>
    <h3>AI-Powered. Gratis. Selalu Siap Membantu</h3>
    <p>Platform AI hukum terpercaya yang bisa Anda gunakan tanpa biaya dan tanpa langganan.</p>
    <p>Dapatkan manfaat langsung:</p>
    <ul>
      <li>Konsultasi & Tanya Jawab Hukum 24/7 Berbasis AI</li>
      <li>Analisis Hukum Dua Bahasa Instan & Mudah Dipahami</li>
      <li>Akses Gratis ke Wawasan & Komunitas Hukum</li>
    </ul>
    <a href="{{ route('cases.index') }}" class="btn btn-primary">Gunakan Sekarang</a>
  </div>
</section>

@endsection
