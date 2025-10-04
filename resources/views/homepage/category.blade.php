@extends('layouts.home')
@section('title', $category->name)
@section('content')
<div class="container py-5">

  <nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a class="text-dark fw-bold text-decoration-none link-primary link-underline-primary" href="{{ route('homepage') }}">Beranda</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
    </ol>
  </nav>

  <div class="row">
    {{-- Sidebar --}}
    <div class="col-lg-3 mb-4">
      <div class="card shadow-sm border-0">
        <div class="card-body">
          <h5 class="fw-bold mb-3">Kategori</h5>
          <ul class="list-unstyled">
            @foreach($allCategories as $cat)
              <li class="mb-2">
                <a href="{{ route('homepage.category', $cat->slug) }}" 
                   class="d-block text-decoration-none text-dark link-primary link-underline-primary {{ $category->id == $cat->id ? 'fw-bold' : '' }}">
                   {{ $cat->name }}
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>
    </div>

    {{-- Content --}}
    <div class="col-lg-9">
      <h3 class="fw-bold mb-4">{{ $category->name }}</h3>

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
          <span class="badge bg-secondary">{{ $article->category->name }}</span>
        </div>
      @empty
        <p class="text-muted">Belum ada artikel di kategori ini.</p>
      @endforelse

      <div class="mt-4">
        {{ $articles->links() }}
      </div>
    </div>
  </div>
</div>
@endsection
