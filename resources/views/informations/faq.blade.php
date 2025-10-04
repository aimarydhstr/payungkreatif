@extends('layouts.home')

@section('title', 'FAQ')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-bold mb-4">FAQ (Pertanyaan yang Sering Diajukan)</h2>
            <p class="mb-4">
                Berikut beberapa pertanyaan yang sering diajukan terkait layanan dan platform <strong>{{ config('app.name') }}</strong>.
            </p>

            <div class="accordion" id="faqAccordion">

                <!-- FAQ 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Apa itu {{ config('app.name') }}?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            {{ config('app.name') }} adalah platform informasi hukum yang menyediakan artikel, berita, dan konten edukatif seputar hukum untuk masyarakat umum.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Apakah layanan ini gratis?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Sebagian besar konten dapat diakses secara gratis. Namun, ada beberapa artikel atau layanan premium yang hanya tersedia bagi pengguna terdaftar atau berlangganan.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Apakah konten di sini bisa dijadikan rujukan hukum resmi?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Konten di situs ini hanya bersifat informatif dan edukatif, bukan merupakan nasihat hukum resmi. Untuk kebutuhan hukum yang spesifik, silakan konsultasi dengan penasihat hukum atau advokat profesional.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Bagaimana cara menghubungi tim {{ config('app.name') }}?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Anda bisa menghubungi kami melalui <a href="{{ route('contact') }}">halaman kontak</a>. 
                            Kami akan berusaha merespons secepat mungkin.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Apakah data saya aman di situs ini?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Kami menerapkan kebijakan privasi yang ketat untuk menjaga keamanan data pengguna. 
                            Silakan baca <a href="{{ route('privacy') }}">Kebijakan Privasi</a> untuk informasi lebih lanjut.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
