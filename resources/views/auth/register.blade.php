@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="container min-vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-md-7 col-lg-6 p-3">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus text-success" style="font-size: 3rem;"></i>
                    <h3 class="fw-bold mt-3">Buat Akun Baru</h3>
                    <p class="text-muted">Silakan daftar untuk mulai menggunakan aplikasi</p>
                </div>

                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Lengkap</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
                            <input type="text" name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   placeholder="Masukkan nama lengkap"
                                   value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-at"></i></span>
                            <input type="text" name="username"
                                   class="form-control @error('username') is-invalid @enderror"
                                   placeholder="Masukkan username"
                                   value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   placeholder="Masukkan email"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   placeholder="Masukkan password"
                                   required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konfirmasi Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-check2-circle"></i></span>
                            <input type="password" name="password_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password"
                                   required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                        <i class="bi bi-person-plus-fill me-1"></i> Register
                    </button>
                </form>

                <div class="text-center mt-4">
                    <small class="text-muted">Sudah punya akun?</small>
                    <a href="{{ route('login') }}" class="fw-semibold text-decoration-none"> Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
