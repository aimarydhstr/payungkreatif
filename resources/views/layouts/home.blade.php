<!-- resources/views/layouts/home.blade.php -->
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title') - {{ config('app.name') }}</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom CSS -->
  <style>
    :root{
      --navy: #083551;
      --navy-dark: #062c42;
      --accent: #ffd000;
      --muted: #6c7a89;
    }

    body{ font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial; background:#fff; color:#0b2433; }

    /* Navbar */
    .site-header { background: var(--navy); color: #fff; box-shadow: 0 2px 6px rgba(2,12,27,0.08); }
    .site-header .navbar-brand { display:flex; align-items:center; gap:.6rem; font-weight:700; color:#fff; }
    .logo-circle { width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-weight:700; font-size:1.1rem; border: 2px solid #fff }
    .search-bar { max-width:640px; width:100%; }
    .search-input, .btn-search { border-radius: 30px; padding:10px 18px; background: #f1f5f8; border: none; }
    .search-input:focus {
        outline: none !important;
        background: #f1f5f8;
        -webkit-appearance: none;
        box-shadow: none;
    }
    .btn-search:hover, .btn-search:active { background: var(--accent); color:#062c42; }
    
    /* Hero / Carousel */
    .hero-card { border-radius:14px; overflow:hidden; border: none; }
    .hero-carousel .carousel-item img { height:420px; object-fit:cover; width:100%; display:block; }
    .hero-overlay {
      position:absolute; left:0; right:0; bottom:0;
      background: linear-gradient(180deg, rgba(4,20,34,0) 0%, rgba(4,20,34,0.65) 50%, rgba(4,20,34,0.85) 100%);
      color:#fff; padding:28px 28px;
    }
    .hero-caption h2 { font-size:1.9rem; font-weight:800; line-height:1.05; margin-bottom:.6rem; }
    .hero-caption .kategory { color: var(--accent); font-weight:700; font-size:.9rem; display:inline-block; margin-bottom:.6rem; }

    .carousel-controls-wrapper {
        display: flex;
        position: absolute;
        right: 20px;
        bottom: 55px;
        width: 75px;
    }

    .carousel-controls-wrapper .carousel-control-next,
    .carousel-controls-wrapper .carousel-control-prev {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        background: #fff;
        opacity: 1;
        color: #062c42;
        display: flex;
        margin: 0 1px;
        align-items: center;
        justify-content: center;
    }
    .carousel-controls-wrapper .carousel-control-next:hover,
    .carousel-controls-wrapper .carousel-control-prev:hover {
        opacity: .8;
    }

    /* small thumbs under hero */
    .mini-thumbs { display:flex; gap:14px; margin-top:14px; }
    .mini-thumb { width:100%; border-radius:8px; overflow:hidden; background:#fff }
    .mini-thumb img { width:100%; height:90px; border-radius: 8px; object-fit:cover; object-position: center; display:block; }
    .mini-thumb .caption { padding:8px 0; font-size:.86rem; color:#1b3b47; overflow:hidden; }

    /* sidebar latest */
    .latest-card { background:#eef7fb; border-radius:10px; padding:12px; }
    .latest-card .small-thumb { width:100%; height:120px; object-fit:cover; border-radius:8px; }

    .latest-list { list-style:none; padding:0; margin:0; }
    .latest-list li { padding:10px 0; border-bottom:1px solid #eee; }
    .latest-list .title { font-weight:700; color:#0b2f3a; }
    .latest-list .meta { font-size:.86rem; color:var(--muted); }

    /* sections below */
    .section-title { font-size:1.25rem; font-weight:800; margin-bottom:14px; color:#0b2f3a; }
    .card-article { border-radius:10px; overflow:hidden; border:none; box-shadow:0 6px 20px rgba(7,24,34,0.06); }
    .card-article img { height:160px; object-fit:cover; }


    /* responsive tweaks */
    @media (max-width: 991px){
      .hero-carousel .carousel-item img { height:260px; }
      .hero-carousel .hero-caption h2 { font-size: 20px }
      .hero-carousel .hero-caption p { display: none; }
      .carousel-control-prev, .carousel-control-next { display:none; }
      .mini-thumb img { height:64px; }
      .pusat-section h5 { font-size: 15px }
    }


    .premium-section { padding: 60px 0; }
    .premium-section h2 { font-weight: 800; margin-bottom: 0.3rem; }
    .premium-section p { color: #555; margin-bottom: 2rem; }

    .card-hero {
      display: block;
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      height: 100%;
      background-size: cover;
      background-position: center;
      color: #fff;
      min-height: 300px;
    }
    .card-hero .overlay {
      position: absolute;
      inset: 0;
      background: linear-gradient(180deg, rgba(0,0,0,0.1) 0%, rgba(0,0,0,0.7) 100%);
      padding: 20px;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
    }
    .card-hero .overlay .date { font-size: 0.85rem; margin-bottom: 0.3rem; }
    .card-hero .overlay h5 { font-weight: 800; font-size: 1.25rem; line-height: 1.2; }
    .card-hero .overlay .author { display: flex; align-items: center; margin-top: 0.5rem; font-size: 0.85rem; }
    .card-hero .overlay .author img { width: 28px; height: 28px; border-radius: 50%; margin-right: 8px; }

    .card-small {
      border-radius: 12px;
      overflow: hidden;
      background: #fff;
      display: flex;
      gap: 15px;
      align-items: center;
    }
    .card-small img { width: 100%; height: 120px; max-width:220px; object-fit: cover; border-radius: 8px; }
    .card-small .content { padding: 8px 0; }
    .card-small .content .meta { font-size: 0.8rem; color: #777; margin-bottom: 0.3rem; }
    .card-small .content h6 { font-weight: 700; font-size: 0.95rem; margin: 0; padding: 5px 0 }
    
    .card-small .content .author { font-size: 13px }
    .card-small .content .author img { width: 32px; height: 32px; object-fit: cover; border-radius: 100%; }

    .btn-see-all {
      display: inline-block;
      margin-top: 2rem;
      background: #0d3c71;
      color: #fff;
      font-weight: 700;
      padding: 0.5rem 1.2rem;
      border-radius: 6px;
      text-decoration: none;
    }

    @media (max-width: 991px) {
      .card-small { flex-direction: row; }
      .card-small img { width: 150px; height: 120px; }
    }

    .hero {
      background: linear-gradient(135deg, #1a1a3f, #0b536d);
      color: #fff;
      padding: 50px;
      position: relative;
      border-radius: 15px;
      overflow: hidden;
    }

    .hero .badge {
      background-color: rgba(255, 255, 255, 0.2);
      border-radius: 50px;
      padding: 5px 15px;
      font-size: 0.9rem;
    }

    .hero h3 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-top: 20px;
      margin-bottom: 20px;
      background: linear-gradient(to right, #b36eff, #66d9ff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    .hero p {
      font-size: 1.1rem;
      margin-bottom: 10px;
      color: #999!important;
    }

    .hero ul {
      list-style: none;
      padding-left: 0;
      margin: 30px 0;
    }

    .hero ul li {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .hero ul li::before {
      content: '✔';
      color: #66d9ff;
      margin-right: 10px;
      font-weight: bold;
    }

    .hero .btn-primary {
      background-color: #ffc107;
      border: none;
      color: #000;
      font-weight: 600;
      padding: 10px 25px;
      border-radius: 8px;
    }

    .hero-img {
      position: absolute;
      right: 30px;
      bottom: 0;
      max-width: 500px;
      height: auto;
    }

    @media (max-width: 992px) {
      .hero {
        padding: 50px 20px;
      }
      .hero-img {
        position: relative;
        right: 0;
        bottom: 0;
        max-width: 100%;
        margin-top: 30px;
      }
    }

    .footer {
      background-color: #fff;
      color: #0a2e4b;
      padding: 50px 0 20px 0;
      font-size: 14px;
    }
    .footer .logo-circle { width:40px; height:40px; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#0a2e4b; font-weight:700; font-size:1.1rem; border: 2px solid #0a2e4b }

    .footer h6 {
        font-weight: 700;
    }
    .footer ul.list-unstyled a {
        font-size: 13px;
    }
    .footer a {
      color: #0a2e4b;
      text-decoration: none;
    }
    .footer a:hover {
      text-decoration: underline;
    }
    .footer .social-icons a {
      display: inline-block;
      margin-right: 10px;
      font-size: 18px;
      color: #0a2e4b;
    }
    .footer .social-icons a:hover {
      color: #fbbf24; /* gold highlight */
    }
    .footer-bottom {
      background-color: #0a2e4b;
      color: #fff;
      padding: 10px 0;
      font-size: 13px;
      text-align: center;
    }
    .certificates img {
      max-height: 50px;
      margin-right: 10px;
      margin-top: 10px;
    }

  </style>
  
</head>
<body>

  <!-- NAVBAR -->
  <header class="site-header">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary py-2" style="background-color:#0a2e4b !important;">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <span class="logo-circle me-2"><i class="bi bi-umbrella"></i></span>
        <div>
          <div style="font-size:.95rem;font-weight:800;">Payung</div>
          <div style="font-size:.78rem;color:#bcd6e6;margin-top:-3px;">Kreatif</div>
        </div>
      </a>

      <!-- Toggle button -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse" id="mainNavbar">

        <!-- Search (desktop) -->
        <div class="mx-lg-4 flex-grow-1 d-none d-lg-block">
          <form action="{{ route('homepage.search') }}" method="GET" class="d-flex align-items-center search-bar">
            <div class="input-group w-100">
              <input 
                class="form-control search-input" 
                type="search" 
                name="q" 
                placeholder="Cari artikel hukum di sini..." 
                value="{{ request('q') }}">
              <button class="btn btn-search" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>

        <!-- Search (mobile inside collapse) -->
        <div class="d-lg-none my-3">
          <form action="{{ route('homepage.search') }}" method="GET">
            <div class="input-group">
              <input 
                class="form-control" 
                type="search" 
                name="q" 
                placeholder="Cari artikel hukum di sini..." 
                value="{{ request('q') }}">
              <button class="btn btn-light" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>

        <!-- Nav links -->
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="{{ route('homepage') }}">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('homepage').'#sec2' }}">Premium Stories</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('homepage').'#sec3' }}">Pusat Data</a></li>
          <li class="nav-item"><a class="nav-link" href="{{ route('homepage').'#sec4' }}">PayungKreatif AI</a></li>
        </ul>

        <!-- Auth buttons -->
        <div class="d-flex gap-2 ms-lg-3">
          @auth
            <a class="btn btn-outline-light btn-sm"
              href="{{ auth()->user()->role === 'admin'
                  ? route('dashboard.admin')
                  : (auth()->user()->role === 'user'
                      ? route('cases.index')
                      : route('dashboard.expert')) }}">
                <i class="bi bi-person"></i> {{ auth()->user()->name }}
            </a>
          @else
            <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}"><i class="bi bi-person"></i> Daftar</a>
            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>


  <!-- MAIN CONTENT -->
  <main class="container my-4">
    @yield('content')
  </main>
  
  <!-- FOOTER -->
  <footer class="footer mb-0 pb-0">
    <div class="container">
        <div class="row">
          <!-- Logo dan Kontak -->
          <div class="col-md-4 mb-3">
              <div class="d-flex gap-2 mb-3">
                  <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="logo-circle"><i class="bi bi-umbrella"></i></span>
                    <div class="ms-2">
                      <div style="font-size:.95rem;font-weight:800;">Payung</div>
                      <div style="font-size:.78rem;color:#0d3c71;margin-top:-3px;">Kreatif</div>
                    </div>
                  </a>
              </div>
              <p class="d-flex gap-2"><i class="bi bi-geo-alt-fill"></i> <span>AD Premier 9th floor, Jl. TB Simatupang No.5 Ragunan, Pasar Minggu, Jakarta Selatan 12550, DKI Jakarta, Indonesia</span></p>
              <p class="d-flex gap-2"><i class="bi bi-telephone-fill"></i> <span>Phone: +6221-2270-8910 <br> Fax: +6221-2270-8909</span></p>
              <p class="d-flex gap-2"><i class="bi bi-envelope-fill"></i> <span>customer@payungkreatif.com <br> redaksi@payungkreatif.com</span></p>
              <div class="social-icons mt-2 mb-3">
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                  <a href="#"><i class="bi bi-youtube"></i></a>
                  <a href="#"><i class="bi bi-x"></i></a>
                  <a href="#"><i class="bi bi-tiktok"></i></a>
              </div>
          </div>

          <!-- Menu Footer -->
          <div class="col-md-8 mb-3" style="line-height:2;">
              <div class="row">
                  <div class="col-md-4 mb-3">
                    <h6>Informasi</h6>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                        <li><a href="{{ route('privacy') }}">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('disclaimer') }}">Disclaimer</a></li>
                        <li><a href="{{ route('faq') }}">FAQ</a></li>
                    </ul>
                  </div>
                  <div class="col-md-4 mb-3">
                      <h6>Info Hukum</h6>
                      <ul class="list-unstyled">
                        @php
                          $catMenu = App\Models\Category::latest()->limit(5)->get();
                        @endphp
                        @foreach ($catMenu as $item)
                          <li><a href="{{ route('homepage.category', $item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                      </ul>
                  </div>
                  <div class="col-md-4 mb-3">
                      <h6>Topik Hukum</h6>
                      <ul class="list-unstyled">
                        @php
                          $tagMenu = App\Models\Tag::latest()->limit(5)->get();
                        @endphp
                        @foreach ($tagMenu as $item)
                          <li><a href="{{ route('homepage.tag', $item->slug) }}">{{ $item->name }}</a></li>
                        @endforeach
                      </ul>
                  </div>
              </div>
          </div>
      </div>

    </div>

    <div class="footer-bottom">
        <div class="container d-block col-md-12 d-md-flex justify-content-between">
            <p>Copyright ©{{ date('Y') }} Payung Kreatif</p>
            <p>All Right Reserved</p>
        </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>