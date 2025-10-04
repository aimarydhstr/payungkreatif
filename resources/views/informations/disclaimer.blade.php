@extends('layouts.home')

@section('title', 'Disclaimer')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">Disclaimer</h2>

            <p>
                Informasi yang disajikan di situs <strong>{{ config('app.name') }}</strong> 
                ditujukan hanya untuk tujuan edukasi dan informasi umum. 
                Kami berusaha memberikan konten yang akurat dan terkini, namun tidak menjamin 
                kelengkapan, keandalan, atau keakuratan informasi tersebut.
            </p>

            <h5 class="mt-4">1. Bukan Nasihat Hukum Resmi</h5>
            <p>
                Konten yang tersedia di situs ini, termasuk artikel maupun jawaban dari chatbot AI, 
                tidak dapat dianggap sebagai nasihat hukum resmi. 
                Chatbot AI memberikan respon otomatis berbasis data dan tidak menggantikan peran advokat atau penasihat hukum profesional. 
                Untuk kebutuhan hukum yang bersifat spesifik, Anda disarankan untuk berkonsultasi langsung 
                dengan ahli hukum yang berkompeten.
            </p>

            <h5 class="mt-4">2. Chat dengan Pakar</h5>
            <p>
                Fitur <em>Chat dengan Pakar</em> menyediakan interaksi dengan praktisi atau ahli yang terdaftar. 
                Meskipun jawaban yang diberikan didasarkan pada keahlian masing-masing pakar, 
                informasi tersebut tetap bersifat umum dan tidak dimaksudkan sebagai pengganti konsultasi hukum formal 
                yang sesuai dengan peraturan perundang-undangan yang berlaku.
            </p>

            <h5 class="mt-4">3. Tanggung Jawab Penggunaan</h5>
            <p>
                Segala keputusan atau tindakan yang Anda ambil berdasarkan informasi dari artikel, 
                chatbot, maupun chat dengan pakar di situs ini sepenuhnya menjadi tanggung jawab Anda sendiri. 
                <strong>{{ config('app.name') }}</strong> tidak bertanggung jawab atas kerugian atau kerusakan 
                yang timbul akibat penggunaan informasi tersebut.
            </p>

            <h5 class="mt-4">4. Tautan Eksternal</h5>
            <p>
                Situs ini mungkin berisi tautan ke situs eksternal yang tidak berada di bawah kendali kami. 
                Kami tidak bertanggung jawab atas isi, kebijakan privasi, maupun praktik dari situs eksternal tersebut.
            </p>

            <h5 class="mt-4">5. Perubahan</h5>
            <p>
                Kami dapat memperbarui atau mengubah halaman disclaimer ini sewaktu-waktu tanpa pemberitahuan sebelumnya. 
                Anda diharapkan meninjau halaman ini secara berkala.
            </p>

            <h5 class="mt-4">6. Kontak</h5>
            <p>
                Jika Anda memiliki pertanyaan terkait disclaimer ini, silakan hubungi kami melalui 
                <a href="{{ route('contact') }}">halaman kontak</a>.
            </p>
        </div>
    </div>
</div>
@endsection
