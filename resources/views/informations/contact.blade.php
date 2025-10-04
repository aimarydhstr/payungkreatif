@extends('layouts.home')

@section('title', 'Kontak')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Kontak Kami</h2>
            <p class="mb-4">
                Ada pertanyaan, kritik, atau saran? Jangan ragu untuk menghubungi kami melalui form berikut:
            </p>

            <form action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nama</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Alamat Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="message" class="form-label">Pesan</label>
                    <textarea name="message" id="message" rows="5" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
</div>
@endsection
