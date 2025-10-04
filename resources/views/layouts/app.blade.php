<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Bootstrap & Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/46.0.2/ckeditor5.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: #fff;
            border-right: 1px solid #e0e0e0;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #333;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 4px 12px;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: #0d6efd;
            color: #fff;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
        }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: #fff;
            border-bottom: 1px solid #e0e0e0;
            padding: 10px 20px;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column">
        <div class="px-5 mb-3">
            <h1>
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="logo-circle me-2"><i class="bi bi-umbrella"></i></span>
                    <div>
                        <div style="font-size:.95rem;font-weight:800;">Payung</div>
                        <div style="font-size:.78rem" class="text-primary">Kreatif</div>
                    </div>
                </a>
            </h1>
        </div>
        <nav class="nav flex-column">
            @if (Auth::user()->role === 'admin')
                <a href="{{ route('dashboard.admin') }}" 
                class="nav-link {{ Route::currentRouteName() === 'dashboard.admin' ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
                <a href="{{ route('users.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'users.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-people"></i> User
                </a>
                <a href="{{ route('articles.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'articles.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-file-earmark-text"></i> Artikel
                </a>
                <a href="{{ route('categories.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'categories.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Kategori
                </a>
                <a href="{{ route('tags.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'tags.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-tags"></i> Tag
                </a>
                
                <a href="{{ route('knowledge-bases.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'knowledge-bases.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Knowledge Base
                </a>

                <a href="{{ route('history') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'history') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> History Review
                </a>

            @elseif (Auth::user()->role === 'user')
                <!-- <a href="{{ route('dashboard.user') }}" 
                class="nav-link {{ Route::currentRouteName() === 'dashboard.user' ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a> -->
                
                <a href="{{ route('cases.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'cases.') || Str::startsWith(Route::currentRouteName(), 'chats.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Chat AI
                </a>
                
                <a href="{{ route('consult-chat.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'consult-chat.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Konsultasi
                </a>
            @else
                <a href="{{ route('dashboard.expert') }}" 
                class="nav-link {{ Route::currentRouteName() === 'dashboard.expert' ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-house-door"></i> Dashboard
                </a>
                
                <a href="{{ route('expert.knowledge-bases.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'expert.knowledge-bases.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Knowledge Base
                </a>
                
                <a href="{{ route('reviews.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'reviews.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Review AI
                </a>

                <a href="{{ route('history.review') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'history.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Riwayat Review
                </a>

                <a href="{{ route('expert.consult-chat.index') }}" 
                class="nav-link {{ Str::startsWith(Route::currentRouteName(), 'expert.consult-chat.') ? 'bg-primary text-white' : '' }}">
                    <i class="bi bi-folder"></i> Konsultasi
                </a>
            @endif
        </nav>

        <div class="mt-auto pb-3 px-4">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 text-start">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-capitalize">Halaman {{ Auth::user()->role }}</h5>
            <div>
                <span class="me-2">Halo, {{ Auth::user()->name ?? 'Admin' }}</span>
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'A') }}" 
                     class="rounded-circle" width="36" height="36" alt="profile">
            </div>
        </div>

        <!-- Page Content -->
        <div class="mt-4">
            @yield('content')
        </div>
    </div>
    

    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function () {
            $('#datatable').DataTable();
        });
    </script>

    @stack('scripts')
</body>
</html>
