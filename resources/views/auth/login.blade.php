@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="container min-vh-100 d-flex justify-content-center align-items-center bg-light">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
                    <h3 class="fw-bold mt-3">Welcome Back</h3>
                    <p class="text-muted">Silakan login untuk melanjutkan</p>
                </div>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-person"></i></span>
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

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                    </button>
                </form>

                <div class="text-center mt-4">
                    <small class="text-muted">Belum punya akun?</small>
                    <a href="{{ route('register') }}" class="fw-semibold text-decoration-none"> Daftar</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
