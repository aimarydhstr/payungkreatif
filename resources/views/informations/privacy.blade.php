@extends('layouts.home')

@section('title', 'Kebijakan Privasi')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Kebijakan Privasi</h2>
            <p>
                Kebijakan privasi ini menjelaskan bagaimana <strong>{{ config('app.name') }}</strong> 
                mengumpulkan, menggunakan, dan melindungi informasi pribadi yang Anda berikan ketika 
                menggunakan layanan kami.
            </p>

            <h5 class="mt-4">1. Informasi yang Kami Kumpulkan</h5>
            <p>
                Kami dapat mengumpulkan informasi pribadi seperti nama, alamat email, dan informasi lain 
                yang relevan ketika Anda mengisi formulir, berlangganan, atau menggunakan fitur tertentu di situs ini.
            </p>

            <h5 class="mt-4">2. Penggunaan Informasi</h5>
            <p>
                Informasi yang kami kumpulkan digunakan untuk:
            </p>
            <ul>
                <li>Meningkatkan pengalaman pengguna.</li>
                <li>Mengirimkan informasi atau notifikasi terkait layanan kami.</li>
                <li>Menanggapi pertanyaan, kritik, dan saran.</li>
            </ul>

            <h5 class="mt-4">3. Perlindungan Data</h5>
            <p>
                Kami berkomitmen untuk menjaga keamanan informasi pribadi Anda. 
                Kami menggunakan prosedur teknis dan administratif yang sesuai untuk mencegah akses 
                yang tidak sah atau penggunaan data secara ilegal.
            </p>

            <h5 class="mt-4">4. Cookies</h5>
            <p>
                Situs kami dapat menggunakan cookies untuk meningkatkan pengalaman pengguna. 
                Anda dapat menonaktifkan cookies melalui pengaturan browser, namun beberapa fitur 
                mungkin tidak berfungsi dengan optimal.
            </p>

            <h5 class="mt-4">5. Perubahan Kebijakan</h5>
            <p>
                Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. 
                Setiap perubahan akan diumumkan melalui halaman ini.
            </p>

            <h5 class="mt-4">6. Kontak</h5>
            <p>
                Jika Anda memiliki pertanyaan terkait kebijakan privasi ini, silakan hubungi kami melalui 
                <a href="{{ route('contact') }}">halaman kontak</a>.
            </p>
        </div>
    </div>
</div>
@endsection
