@extends('layouts.home')
@section('title', 'Tentang Kami')

@section('content')
<div class="container py-5">

  <!-- Header -->
  <div class="row justify-content-center mb-5 text-center">
    <div class="col-lg-8">
      <h1 class="fw-bold mb-3">Tentang Kami</h1>
      <p class="lead text-muted">
        Selamat datang di <strong>Payung Kreatif</strong>, platform hukum modern yang menghadirkan analisis, pusat data, dan wawasan hukum mudah diakses.
      </p>
      <img src="https://picsum.photos/800/300?random=1" class="img-fluid mt-3 rounded" alt="Tentang Kami Illustrasi">
    </div>
  </div>

  <!-- Visi & Misi -->
  <div class="row align-items-center mb-5">
    <div class="col-md-6">
      <img src="https://picsum.photos/600/400?random=2" class="img-fluid rounded" alt="Visi Misi">
    </div>
    <div class="col-md-6 mt-4 mt-md-0">
      <h3 class="fw-bold mb-3">Visi & Misi</h3>
      <p>
        Kami percaya hukum harus dapat dipahami semua orang. Visi kami adalah menjadi <em>jembatan pengetahuan hukum</em> yang transparan dan terpercaya.
      </p>
      <ul class="list-unstyled">
        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Menyediakan informasi hukum yang akurat dan mutakhir</li>
        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Mempermudah akses publik ke literatur dan analisis hukum</li>
        <li class="mb-2"><i class="bi bi-check-circle-fill text-primary me-2"></i>Mendukung masyarakat untuk mengambil keputusan hukum yang tepat</li>
      </ul>
    </div>
  </div>

  <!-- Tim Kami -->
  <div class="mb-5 text-center">
    <h3 class="fw-bold mb-4">Tim Kami</h3>
    <div class="row g-4 justify-content-center">
      @php
        $team = [
          ['name'=>'Alex','role'=>'Founder & CEO','img'=>'https://picsum.photos/150?random=3'],
          ['name'=>'Maria','role'=>'CTO','img'=>'https://picsum.photos/150?random=4'],
          ['name'=>'Liam','role'=>'Legal Analyst','img'=>'https://picsum.photos/150?random=5'],
          ['name'=>'Sophia','role'=>'AI Engineer','img'=>'https://picsum.photos/150?random=6'],
        ];
      @endphp
      @foreach($team as $member)
      <div class="col-6 col-md-3">
        <div class="card border-0 h-100 text-center">
          <img src="{{ $member['img'] }}" 
               class="rounded-circle mx-auto mt-3" style="width:120px; height:120px; object-fit:cover;" 
               alt="{{ $member['role'] }}">
          <div class="card-body">
            <h6 class="fw-bold mb-1">{{ $member['name'] }}</h6>
            <p class="text-muted mb-0">{{ $member['role'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>

  <!-- Hubungi Kami -->
  <div class="text-center py-5 bg-light rounded">
    <h3 class="fw-bold mb-3">Hubungi Kami</h3>
    <p class="text-muted mb-3">
      Ada pertanyaan atau ingin bekerja sama? Hubungi kami melalui email: 
      <a href="mailto:info@payungkreatif.com" class="text-decoration-none fw-bold">info@payungkreatif.com</a>
    </p>
    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Form Kontak</a>
  </div>

</div>
@endsection
