<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $articlesData = [
            [
                'title' => 'UMKM Kreatif di Indonesia Kini Lebih Mudah Lindungi Hak Cipta Karyanya',
                'body' => "
                    <p>Seiring pertumbuhan UMKM kreatif di Indonesia, perlindungan hak cipta menjadi isu yang semakin penting. 
                    Pelaku usaha kini dapat mendaftarkan karya mereka secara daring melalui Direktorat Jenderal Kekayaan Intelektual.</p>

                    <p><img src='https://picsum.photos/seed/umkmnews1/800/400' alt='UMKM Kreatif'></p>

                    <p>Proses ini membantu UMKM menghindari risiko tiruan, serta memberikan nilai tambah bagi bisnis mereka. 
                    Banyak desainer, pembuat kerajinan tangan, dan pengembang produk digital memanfaatkan fasilitas ini.</p>

                    <p>Selain itu, pemerintah mengadakan pelatihan dan sosialisasi mengenai hak cipta untuk meningkatkan kesadaran hukum di kalangan pelaku usaha.</p>

                    <p>UMKM yang melindungi karya mereka secara resmi memiliki bukti legal yang kuat untuk menghadapi sengketa atau pelanggaran hak cipta.</p>

                    <p>Dengan perlindungan yang memadai, UMKM kreatif dapat berkembang lebih profesional dan berkelanjutan, membuka peluang pasar baru, dan meningkatkan daya saing di tingkat nasional maupun internasional.</p>
                "
            ],
            [
                'title' => 'Tips Aman bagi Freelancer Kreatif untuk Menghindari Sengketa Kontrak',
                'body' => "
                    <p>Banyak freelancer kreatif menghadapi risiko sengketa karena kontrak yang tidak jelas. 
                    Menyusun kontrak kerja yang formal sangat penting untuk melindungi hak cipta, durasi pekerjaan, dan pembayaran.</p>

                    <p><img src='https://picsum.photos/seed/freelancenews/800/400' alt='Freelance Kreatif'></p>

                    <p>Ahli hukum menyarankan agar setiap freelancer memiliki kontrak tertulis sebelum memulai proyek. 
                    Kontrak ini dapat berupa dokumen PDF atau surat elektronik yang ditandatangani kedua pihak.</p>

                    <p>Selain itu, kontrak harus memuat klausul hak cipta, penggunaan karya, dan mekanisme penyelesaian sengketa. 
                    Hal ini memberikan perlindungan hukum yang lebih kuat.</p>

                    <p>Dengan kontrak yang tepat, freelancer dapat fokus pada kreativitas mereka tanpa khawatir haknya dilanggar, sehingga proyek berjalan lancar dan aman secara hukum.</p>

                    <p>Pemahaman tentang hak dan kewajiban melalui kontrak juga meningkatkan profesionalisme freelancer di industri kreatif.</p>
                "
            ],
            [
                'title' => 'BPJS Kini Memperluas Jangkauan Perlindungan untuk Pekerja Kreatif dan UMKM',
                'body' => "
                    <p>Pekerja kreatif freelance dan pelaku UMKM kini dapat mendaftar BPJS Kesehatan dan Ketenagakerjaan secara mandiri. 
                    Hal ini memberikan perlindungan sosial yang sebelumnya sulit diakses oleh pekerja non-formal.</p>

                    <p><img src='https://picsum.photos/seed/bpjsnews/800/400' alt='BPJS Pekerja Kreatif'></p>

                    <p>BPJS Kesehatan memastikan setiap pekerja memperoleh layanan medis, sementara BPJS Ketenagakerjaan memberikan jaminan kecelakaan kerja dan pensiun. 
                    Pendaftaran dapat dilakukan secara online melalui aplikasi resmi BPJS.</p>

                    <p>Langkah ini meningkatkan kesejahteraan dan keamanan finansial pekerja kreatif, serta memberi perlindungan hukum jika terjadi kecelakaan kerja.</p>

                    <p>Pemerintah juga menyediakan panduan dan sosialisasi untuk memudahkan pendaftaran dan pemahaman hak-hak pekerja.</p>

                    <p>Dengan akses BPJS yang lebih luas, sektor kreatif dapat berkembang lebih aman dan terstruktur, mendukung pertumbuhan ekonomi lokal.</p>
                "
            ],
            [
                'title' => 'Startup Kreatif Perlu Memahami Aturan Pajak dan Hak Cipta',
                'body' => "
                    <p>Banyak startup di bidang kreatif mengabaikan peraturan pajak dan hak cipta, yang dapat menimbulkan risiko hukum. 
                    Pemahaman yang baik terhadap regulasi menjadi kunci keberhasilan dan keamanan usaha.</p>

                    <p><img src='https://picsum.photos/seed/startupnews/800/400' alt='Startup Kreatif'></p>

                    <p>Ahli hukum menyarankan setiap startup memiliki tim hukum atau konsultan untuk memastikan kepatuhan terhadap pajak dan perlindungan kekayaan intelektual. 
                    Hal ini termasuk pendaftaran hak cipta produk digital, logo, dan merek dagang.</p>

                    <p>Penerapan prosedur hukum yang benar meningkatkan kepercayaan investor dan konsumen terhadap startup kreatif.</p>

                    <p>Selain itu, startup yang mematuhi regulasi memiliki keuntungan strategis dalam membangun reputasi bisnis yang kredibel dan profesional.</p>

                    <p>Pembekalan hukum sejak awal akan mencegah sengketa dan memberikan kepastian hukum bagi pengembangan inovasi kreatif di masa depan.</p>
                "
            ],
            [
                'title' => 'Kolaborasi Kreator Lokal dan UMKM Tingkatkan Ekonomi Kreatif',
                'body' => "
                    <p>Kolaborasi antara kreator lokal dan UMKM semakin marak di Indonesia. 
                    Melalui kolaborasi ini, UMKM memperoleh konten kreatif berkualitas, sementara kreator mendapatkan proyek resmi secara hukum.</p>

                    <p><img src='https://picsum.photos/seed/kolaborasinews/800/400' alt='Kolaborasi Kreator'></p>

                    <p>Kontrak tertulis harus disusun untuk mengatur hak cipta, pembagian keuntungan, dan durasi proyek agar jelas bagi kedua pihak.</p>

                    <p>Kolaborasi yang terstruktur meningkatkan profesionalisme dan keberlanjutan ekosistem kreatif lokal.</p>

                    <p>Selain itu, proyek kolaborasi sering menarik perhatian media dan investor, membuka peluang pasar baru bagi UMKM dan kreator.</p>

                    <p>Pendampingan hukum dalam kolaborasi ini memastikan semua pihak terlindungi dan mendorong pertumbuhan ekonomi kreatif yang sehat.</p>
                "
            ],
        ];

        $thumbnails = [
            'thumbnails/article1.jpg',
            'thumbnails/article2.jpg',
            'thumbnails/article3.jpg',
            'thumbnails/article4.jpg',
            'thumbnails/article5.jpg',
        ];

        foreach ($articlesData as $i => $data) {
            $statusOptions = ['draft','scheduled','published'];
            $status = $statusOptions[array_rand($statusOptions)];
            $published_at = $status === 'published' ? now()->subDays(rand(0,90)) : null;

            $article = Article::create([
                'author_id' => 1, // pastikan authors sudah ada
                'category_id' => rand(1,4), // pastikan kategori ada
                'title' => $data['title'],
                'slug' => Str::slug($data['title'] . '-' . time() . "-{$i}"),
                'thumbnail' => $thumbnails[$i % 5],
                'body' => $data['body'],
                'is_featured' => 0,
                'status' => $status,
                'published_at' => $published_at,
                'meta_title' => $data['title'],
                'meta_description' => Str::limit(strip_tags($data['body']), 150),
            ]);

            // Attach tags acak 1-3
            $tagIds = range(1,5);
            shuffle($tagIds);
            $article->tags()->sync(array_slice($tagIds,0,rand(1,3)));
        }
    }
}
