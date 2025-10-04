@extends('layouts.home')
@section('title', $tagItem->name)
@section('content')
<div class="container py-5">

  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-dark fw-bold text-decoration-none link-primary link-underline-primary" href="{{ route('homepage') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $tagItem->name }}</li>
    </ol>
  </nav>

  <div class="row">
    {{-- Sidebar --}}
    <div class="col-lg-3 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Tag</h5>
          <ul class="list-unstyled">
            @foreach($allTag as $tag)
              <li class="mb-2">
                <a href="{{ route('homepage.tag', $tag->slug) }}" 
                   class="d-block text-decoration-none text-dark link-primary link-underline-primary {{ $tag->id == $tagItem->id ? 'fw-bold' : '' }}">
                   {{ $tag->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    {{-- Content --}}
    <div class="col-lg-9">
      <h3 class="fw-bold mb-4">{{ $tagItem->name }}</h3>

      @forelse($articles as $article)
        <div class="border-bottom pb-3 mb-3">
          <h5 class="mb-1">
            <a href="{{ route('homepage.show', $article->slug) }}" class="text-dark link-primary link-underline-primary text-decoration-none fw-bold">
              {{ $article->title }}
            </a>
          </h5>
          <div class="small text-muted mb-2">
            {{ $article->author->display_name ?? 'Unknown' }} · {{ $article->created_at->format('d M Y') }}
          </div>
          @foreach($article->tags as $tag)
          <span class="badge bg-secondary">{{ $tag->name }}</span>
          @endforeach
        </div>
      @empty
        <p class="text-muted">Belum ada artikel di tag ini.</p>
      @endforelse

      <div class="mt-4">
        {{ $articles->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
