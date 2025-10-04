<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>HukumOnline</title>

  <!-- Fonts & Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
    }

    .premium-section { padding: 60px 0; }
    .premium-section h2 { font-weight: 800; margin-bottom: 0.3rem; }
    .premium-section p { color: #555; margin-bottom: 2rem; }

    .card-hero {
      border-radius: 12px;
      overflow: hidden;
      position: relative;
      height: 100%;
      background-size: cover;
      background-position: center;
      color: #fff;
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
      .card-small img { width: 90px; height: 70px; }
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
    <div class="container py-3">
      <div class="d-flex align-items-center gap-3">
        <a class="navbar-brand d-flex align-items-center" href="#">
          <span class="logo-circle">H</span>
          <div>
            <div style="font-size:.95rem;font-weight:800;">Hukum</div>
            <div style="font-size:.78rem;color:#bcd6e6;margin-top:-3px;">online.com</div>
          </div>
        </a>

        <!-- search center -->
        <div class="flex-grow-1 mx-3 d-none d-md-block">
          <form class="d-flex align-items-center search-bar">
            <div class="input-group w-100">
              <input class="form-control search-input" type="search" placeholder="Cari artikel hukum di sini..." aria-label="Search">
              <button class="btn btn-search" type="submit"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>

        <!-- right menu -->
        <nav class="d-flex gap-3 align-items-center">
          <ul class="nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link text-white" href="#">Pro</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Solusi</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Info Hukum</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="#">Event & Awards</a></li>
          </ul>
          <div class="d-flex gap-2 align-items-center">
            @if (Auth::user())
            <a class="btn btn-outline-light btn-sm"
              href="{{ Auth::user()->role === 'admin'
                  ? route('dashboard.admin')
                  : (Auth::user()->role === 'user'
                      ? route('dashboard.user')
                      : route('dashboard.pakar')) }}">
                <i class="bi bi-person"></i> {{ Auth::user()->name }}
            </a>
            @else
            <a class="btn btn-outline-light btn-sm" href="{{ route('register') }}"><i class="bi bi-person"></i> Daftar</a>
            <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}"><i class="bi bi-box-arrow-in-right"></i> Masuk</a>
            @endif
          </div>
        </nav>
      </div>
    </div>
  </header>

  <!-- HERO + SIDEBAR -->
  <main class="container my-4">
    <div class="row gx-4">
      <!-- left hero -->
      <div class="col-lg-8">
        <div class="position-relative">
          <div id="heroCarousel" class="carousel slide hero-card" data-bs-ride="carousel">
            <div class="carousel-inner hero-carousel position-relative">
              <div class="carousel-item active position-relative">
                <img src="https://picsum.photos/1200/600?random=11" class="d-block w-100" alt="Hero 1">
                <div class="hero-overlay">
                  <div class="hero-caption">
                    <div class="kategory">Utama</div>
                    <h2>Ada Kekhawatiran Perluasan Peran TNI Di Penegakan Hukum Dalam Pembahasan RKUHAP</h2>
                    <p style="max-width:70%; color: rgba(255,255,255,0.95);">Pembahasan RKUHAP mengundang reaksi dari berbagai pihak karena ada titik yang dianggap memperluas peran aparat militer dalam penegakan hukum sipil.</p>
                    <div class="mt-3">
                      <a href="#" class="btn" style="background:var(--accent); color:#062c42; font-weight:700; border-radius:8px;">Selengkapnya ➜</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="carousel-item position-relative">
                <img src="https://picsum.photos/1200/600?random=12" class="d-block w-100" alt="Hero 2">
                <div class="hero-overlay">
                  <div class="hero-caption">
                    <div class="kategory">Analisis</div>
                    <h2>Kerangka Baru Hukum Perdata & Implikasinya Bagi Kontrak Bisnis</h2>
                    <p style="max-width:70%; color: rgba(255,255,255,0.95);">Perubahan pasal-pasal kunci membawa tantangan baru bagi pelaku usaha dalam menyusun kontrak yang aman secara hukum.</p>
                    <div class="mt-3">
                      <a href="#" class="btn" style="background:var(--accent); color:#062c42; font-weight:700; border-radius:8px;">Selengkapnya ➜</a>
                    </div>
                  </div>
                </div>
              </div>

              <div class="carousel-item position-relative">
                <img src="https://picsum.photos/1200/600?random=13" class="d-block w-100" alt="Hero 3">
                <div class="hero-overlay">
                  <div class="hero-caption">
                    <div class="kategory">Legal Intelligence</div>
                    <h2>OJK Siapkan Rencana Deregulasi di Sektor PVML</h2>
                    <p style="max-width:70%; color: rgba(255,255,255,0.95);">Rencana deregulasi dirancang untuk meningkatkan efisiensi namun menimbulkan perdebatan terkait perlindungan konsumen.</p>
                    <div class="mt-3">
                      <a href="#" class="btn" style="background:var(--accent); color:#062c42; font-weight:700; border-radius:8px;">Selengkapnya ➜</a>
                    </div>
                  </div>
                </div>
              </div>
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
          <div class="d-flex justify-content-between mt-3 mini-thumbs">
            <div class="mini-thumb">
              <img src="https://picsum.photos/300/200?random=21" alt="">
              <div class="caption">Menuduh Orang Selingkuh, Apa Sanksinya?</div>
            </div>
            <div class="mini-thumb">
              <img src="https://picsum.photos/300/200?random=22" alt="">
              <div class="caption">Cross Border Insolvency: Tantangan dan Arah</div>
            </div>
            <div class="mini-thumb">
              <img src="https://picsum.photos/300/200?random=23" alt="">
              <div class="caption">Korupsi Bukan Sekedar Kejahatan, Tapi...</div>
            </div>
            <div class="mini-thumb d-none d-lg-block">
              <img src="https://picsum.photos/300/200?random=24" alt="">
              <div class="caption">Ada Kekhawatiran Perluasan Peran TNI di ...</div>
            </div>
          </div>
        </div>
      </div>

      <!-- right sidebar -->
      <aside class="col-lg-4">
        <div class="latest-card mb-3">
          <div class="row g-2">
            <div class="col-4">
              <img src="https://picsum.photos/300/180?random=31" class="small-thumb" alt="">
            </div>
            <div class="col-8 position-relative">
              <div style="font-size:.82rem;color:#4b6b77;font-weight:700;">Legal Intelligence Updates <span class="badge bg-warning text-dark ms-1">New</span></div>
              <h6 style="margin-top:6px;font-weight:800;color:#062c42;">OJK Siapkan Rencana Deregulasi di Sektor PVML</h6>
              <a href="#" class="stretched-link text-decoration-none" style="color:#0a5d72;"></a>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-2">
          <h4 style="margin:0;font-weight:800;">Terbaru</h4>
          <div style="color:#8aa8b2;font-size:.88rem;">18 Agt 2025</div>
        </div>

        <ul class="latest-list mb-3">
          <li>
            <div class="title">Iuran PBI JKN Berpotensi Naik, Tapi Belum Cukup Mengatasi Defisit</div>
            <div class="meta">14 Agt 2025 · Analisis</div>
          </li>
          <li>
            <div class="title">Cerita di Balik Mundurnya Bung Hatta dari Jabatan Wakil Presiden</div>
            <div class="meta">13 Agt 2025 · Premium Stories</div>
          </li>
          <li>
            <div class="title">Putusan PTUN: Dampak pada Tata Kelola Pemerintah Daerah</div>
            <div class="meta">12 Agt 2025 · Putusan</div>
          </li>
          <li>
            <div class="title">Cerita di Balik Mundurnya Bung Hatta dari Jabatan Wakil Presiden</div>
            <div class="meta">13 Agt 2025 · Premium Stories</div>
          </li>
        </ul>

        <a href="#" class="d-inline-flex align-items-center" style="color:#0a5d72;font-weight:700;text-decoration:none;">Lihat Semua <i class="bi bi-arrow-right ms-2"></i></a>

      </aside>
    </div>

    <section class="premium-section container">
        <div class="text-center mb-4">
        <h2>Premium Stories</h2>
        <p>Temukan artikel hukum komprehensif dari Hukumonline!</p>
        </div>

        <div class="row g-4">
        <!-- Card besar kiri -->
        <div class="col-lg-6">
            <div class="card-hero" style="background-image: url('https://picsum.photos/600/400?random=1');">
            <div class="overlay">
                <div class="date">Senin, 18 Agustus 2025 · Bacaan 9 menit</div>
                <h5><a href="#" class="text-decoration-none" style="color:#fff;">Cerita Di Balik Mundurnya Bung Hatta Dari Jabatan Wakil Presiden</a></h5>
                <div class="author">
                <img src="https://i.pravatar.cc/28?img=5" alt="author">
                Muhammad Yasin
                </div>
            </div>
            </div>
        </div>

        <!-- Dua card kecil kanan -->
        <div class="col-lg-6 d-flex flex-column align-item-strecht">
            <div class="card-small">
            <img src="https://picsum.photos/120/80?random=2" alt="">
            <div class="content">
                <div class="meta">15 Agt 2025 · Bacaan 7 menit</div>
                <h6>Proyeksi Mekanisme Pailit dan PKPU pada Koperasi Merah Putih</h6>
                <div class="author" style="margin-top: 0.3rem;">
                <img src="https://i.pravatar.cc/28?img=6" alt="author"> Fitri Novia Heriani
                </div>
            </div>
            </div>
            <hr>
            <div class="card-small">
            <img src="https://picsum.photos/120/80?random=3" alt="">
            <div class="content">
                <div class="meta">14 Agt 2025 · Bacaan 9 menit</div>
                <h6>Peninjauan Kembali Sejumlah Gugatan Lain-Lain Kepailitan</h6>
                <div class="author" style="margin-top: 0.3rem;">
                <img src="https://i.pravatar.cc/28?img=7" alt="author"> Fitri Novia Heriani
                </div>
            </div>
            </div>

        </div>
        </div>

        <div class="text-center">
        <a href="#" class="btn-see-all">Lihat Semua</a>
        </div>
    </section>

    <!-- sections below: Pusat Data & Legal Analysis -->
    <div class="row mt-5 gx-4">
      <div class="col-lg-8">
        <div class="d-flex justify-content-between align-items-start mb-3">
          <div>
            <div class="section-title">Pusat Data</div>
            <div style="height:3px;width:60px;background:#0a5d72;border-radius:3px;margin-top:-8px;"></div>
          </div>
          <a href="#" style="color:#0a5d72;font-weight:700;">SELENGKAPNYA ➜</a>
        </div>

        <div class="row g-3">
          <div class="col-12">
            <div class="card-small">
              <img src="https://picsum.photos/800/500?random=41" class="card-img-top" alt="">
              <div class="content">
                <h5 class="card-title" style="font-weight:800;">Statistik Putusan Pengadilan 2025</h5>
                <p class="card-text" style="color:#5b7178;">Rangkuman putusan pengadilan selama tahun berjalan yang memberikan gambaran tren hukum terkini.</p>
              </div>
            </div>
          </div>
          <div class="col-12">
            <div class="card-small">
              <img src="https://picsum.photos/800/500?random=42" class="card-img-top" alt="">
              <div class="card-body">
                <h5 class="card-title" style="font-weight:800;">Indeks Risiko Hukum di Sektor Energi</h5>
                <p class="card-text" style="color:#5b7178;">Analisis data per sektor untuk membantu praktisi menilai risiko kepatuhan dan litigasi.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- more rows -->
      </div>

      <div class="col-lg-4">
        <div class="section-title">Legal Analysis <span class="badge bg-light text-dark ms-2" style="font-weight:700;">Pro</span></div>
        <ul class="latest-list mb-3">
          <li>
            <div class="title">Iuran PBI JKN Berpotensi Naik, Tapi Belum Cukup Mengatasi Defisit</div>
            <div class="meta">14 Agt 2025 · Analisis</div>
          </li>
          <li>
            <div class="title">Cerita di Balik Mundurnya Bung Hatta dari Jabatan Wakil Presiden</div>
            <div class="meta">13 Agt 2025 · Premium Stories</div>
          </li>
          <li>
            <div class="title">Putusan PTUN: Dampak pada Tata Kelola Pemerintah Daerah</div>
            <div class="meta">12 Agt 2025 · Putusan</div>
          </li>
        </ul>
      </div>
    </div>

    <section class="hero d-flex flex-column flex-lg-row align-items-start justify-content-between mt-5">
        <div class="hero-text me-lg-5">
            <span class="badge">Hukumonline Pro Intelligence</span>
            <h3>AI-Powered. Trustworthy. Prominent Networking</h3>
            <p>Platform AI hukum terpercaya sebagai solusi komprehensif Anda.</p>
            <p>Mulai berlangganan dan dapatkan:</p>
            <ul>
                <li>Tanya Jawab Hukum 24/7 Berbasis AI</li>
                <li>Analisis Hukum Dua Bahasa Langsung ke Email Anda</li>
                <li>Akses ke Komunitas Hukum Terbesar di Tanah Air</li>
            </ul>
            <a href="#" class="btn btn-primary">Berlangganan Sekarang</a>
        </div>
    </section>

  </main>

  <!-- FOOTER -->
  <footer class="footer mb-0 pb-0">
    <div class="container">
        <div class="row mb-4">
        <!-- Logo dan Kontak -->
        <div class="col-md-3 mb-3">
            <div class="d-flex gap-2 mb-3">
                <span class="logo-circle">H</span>
                <div>
                    <div style="font-size:.95rem;font-weight:800;">Hukum</div>
                    <div style="font-size:.78rem;color:#555;margin-top:-3px;">online.com</div>
                </div>
            </div>
            <p class="d-flex gap-2"><i class="bi bi-geo-alt-fill"></i> <span>AD Premier 9th floor, Jl. TB Simatupang No.5 Ragunan, Pasar Minggu, Jakarta Selatan 12550, DKI Jakarta, Indonesia</span></p>
            <p class="d-flex gap-2"><i class="bi bi-telephone-fill"></i> <span>Phone: +6221-2270-8910 <br> Fax: +6221-2270-8909</span></p>
            <p class="d-flex gap-2"><i class="bi bi-envelope-fill"></i> <span>customer@hukumonline.com <br> redaksi@hukumonline.com</span></p>
            <div class="social-icons mt-2">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-instagram"></i></a>
            <a href="#"><i class="bi bi-linkedin"></i></a>
            <a href="#"><i class="bi bi-youtube"></i></a>
            <a href="#"><i class="bi bi-x"></i></a>
            <a href="#"><i class="bi bi-tiktok"></i></a>
            </div>
        </div>

        <!-- Menu Footer -->
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <h6>Pro</h6>
                    <ul class="list-unstyled">
                    <li><a href="#">Analisis Hukum</a></li>
                    <li><a href="#">Pusat Data</a></li>
                    <li><a href="#">Legal Intelligence</a></li>
                    <li><a href="#">Updates</a></li>
                    <li><a href="#">Premium Stories</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Solusi</h6>
                    <ul class="list-unstyled">
                    <li><a href="#">University Solutions</a></li>
                    <li><a href="#">Regulatory Compliance System</a></li>
                    <li><a href="#">Document Management System</a></li>
                    <li><a href="#">Izin Usaha</a></li>
                    <li><a href="#">Konsultasi Hukum</a></li>
                    <li><a href="#">Pembuatan Dokumen</a></li>
                    <li><a href="#">Hukumonline 360</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Info Hukum</h6>
                    <ul class="list-unstyled">
                    <li><a href="#">Klinik</a></li>
                    <li><a href="#">Hukumonline Stream</a></li>
                    <li><a href="#">Jurnal</a></li>
                    <li><a href="#">Berita</a></li>
                    <li><a href="#">Data Pribadi</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h6>Event & Awards</h6>
                    <ul class="list-unstyled">
                    <li><a href="#">Event</a></li>
                    <li><a href="#">Awards</a></li>
                    <li><a href="#">Publikasi Online</a></li>
                    <li><a href="#">Online Course</a></li>
                    <li><a href="#">PKPA</a></li>
                    </ul>
                </div>
                <div class="col-md-4 mb-3">
                    <h6>Hukumonline</h6>
                    <ul class="list-unstyled">
                    <li><a href="#">Tentang Kami</a></li>
                    <li><a href="#">Katalog Produk</a></li>
                    <li><a href="#">Redaksi</a></li>
                    <li><a href="#">Pedoman Media Siber</a></li>
                    <li><a href="#">Kode Etik</a></li>
                    <li><a href="#">Syarat Penggunaan Layanan</a></li>
                    <li><a href="#">Bantuan & FAQ</a></li>
                    <li><a href="#">Karir</a></li>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container d-flex justify-content-between">
            <p>© 2025 Hak Cipta Milik Hukumonline.com</p>
            <p>• &nbsp; Cookies Settings &nbsp; • &nbsp; Cookies Info</p>
        </div>
    </div>
  </footer>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
