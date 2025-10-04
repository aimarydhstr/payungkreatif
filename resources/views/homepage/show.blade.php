@extends('layouts.home')
@section('title', $article->title)
@section('content')
<div class="container my-5">
  <div class="row">
    <div class="col-lg-8">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
          <li class="breadcrumb-item"><a href="{{ route('homepage.category', $article->category->slug ?? 'umum') }}">{{ $article->category->name ?? 'Kategori' }}</a></li>
          <li class="breadcrumb-item active" style="width: 50%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;" aria-current="page">{{ $article->title }}</li>
        </ol>
      </nav>
      
      <h2 class="fw-bold mb-2">{{ $article->title }}</h2>

      <div class="d-flex align-items-center mb-3">
        <img src="https://i.pravatar.cc/40?u={{ $article->author->id ?? 1 }}" 
             class="rounded-circle me-2" alt="Author">
        <div>
          <div class="fw-semibold">{{ $article->author->display_name ?? 'Anonim' }}</div>
          <small class="text-muted">
            {{ $article->created_at->format('d F Y') }} · {{ $article->category->name ?? 'Umum' }}
          </small>
        </div>
      </div>

      <img src="{{ asset('storage/uploads/' . $article->thumbnail) ?? 'https://picsum.photos/900/500' }}" 
           class="img-fluid rounded mb-4 w-100" alt="{{ $article->title }}">

      <article class="content mb-5">
        {!! $article->body !!}
      </article>
    </div>

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
                 class="fw-semibold text-dark d-block text-decoration-none primary-link primary-link-underline">
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

<style>
  .content img {
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
  }
</style>