<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================
        // USERS
        // ============================
        $admin = \App\Models\User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
        ]);

        $expert1 = \App\Models\User::create([
            'name' => 'Charles White',
            'username' => 'charles',
            'email' => 'charles@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'expert',
            'status' => 'active',
        ]);

        $expert2 = \App\Models\User::create([
            'name' => 'Maria Siregar',
            'username' => 'maria',
            'email' => 'maria@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'expert',
            'status' => 'active',
        ]);

        $user1 = \App\Models\User::create([
            'name' => 'Joe Dohn',
            'username' => 'joedohn',
            'email' => 'joedohn@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);

        $user2 = \App\Models\User::create([
            'name' => 'Rahmat Hidayat',
            'username' => 'rahmat',
            'email' => 'rahmat@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
            'status' => 'active',
        ]);

        // ============================
        // AUTHORS
        // ============================
        $author1 = \App\Models\Author::create([
            'user_id' => $admin->id,
            'display_name' => 'Redaksi Portal',
            'bio' => 'Tim redaksi hukum yang berfokus pada isu-isu nasional dan internasional.',
        ]);

        // ============================
        // CATEGORIES
        // ============================
        $cat1 = \App\Models\Category::create(['name'=>'Hukum Perdata','slug'=>'hukum-perdata']);
        $cat2 = \App\Models\Category::create(['name'=>'Hukum Pidana','slug'=>'hukum-pidana']);
        $cat3 = \App\Models\Category::create(['name'=>'Hukum Tata Negara','slug'=>'hukum-tata-negara']);
        $cat4 = \App\Models\Category::create(['name'=>'Hukum Dagang','slug'=>'hukum-dagang']);

        // ============================
        // TAGS
        // ============================
        $tag1 = \App\Models\Tag::create(['name'=>'Perjanjian','slug'=>'perjanjian']);
        $tag2 = \App\Models\Tag::create(['name'=>'Kontrak','slug'=>'kontrak']);
        $tag3 = \App\Models\Tag::create(['name'=>'Pidana Khusus','slug'=>'pidana-khusus']);
        $tag4 = \App\Models\Tag::create(['name'=>'Konstitusi','slug'=>'konstitusi']);
        $tag5 = \App\Models\Tag::create(['name'=>'Ekonomi','slug'=>'ekonomi']);

        // ============================
        // ARTICLES (manual)
        // ============================
        $articles = [
            [
                'author_id' => $author1->id,
                'category_id' => $cat1->id,
                'title' => 'Dasar-Dasar Perjanjian dalam Hukum Perdata',
                'thumbnail' => 'thumbnails/article1.jpg',
                'body' => '<p>Artikel ini membahas dasar hukum mengenai perjanjian sesuai KUH Perdata.</p>',
                'tags' => [$tag1->id, $tag2->id],
              ],
              [
                'author_id' => $author1->id,
                'category_id' => $cat2->id,
                'title' => 'Jenis-Jenis Pidana Khusus di Indonesia',
                'thumbnail' => 'thumbnails/article2.jpg',
                'body' => '<p>Membahas tindak pidana khusus yang diatur dalam undang-undang tertentu.</p>',
                'tags' => [$tag3->id],
              ],
              [
                'author_id' => $author1->id,
                'category_id' => $cat3->id,
                'title' => 'Konstitusi sebagai Sumber Hukum Tertinggi',
                'thumbnail' => 'thumbnails/article3.jpg',
                'body' => '<p>UUD 1945 sebagai sumber hukum tertinggi dalam tata hukum Indonesia.</p>',
                'tags' => [$tag4->id],
              ],
              [
                'author_id' => $author1->id,
                'category_id' => $cat4->id,
                'title' => 'Perkembangan Hukum Dagang di Era Digital',
                'thumbnail' => 'thumbnails/article4.jpg',
                'body' => '<p>E-commerce membawa perubahan besar terhadap regulasi hukum dagang.</p>',
                'tags' => [$tag2->id, $tag5->id],
              ],
              [
                'author_id' => $author1->id,
                'category_id' => $cat1->id,
                'title' => 'Hukum Waris dalam Perspektif Perdata',
                'thumbnail' => 'thumbnails/article5.jpg',
                'body' => '<p>Mengulas ketentuan hukum waris dalam KUH Perdata.</p>',
                'tags' => [$tag1->id],
            ],
        ];

        foreach ($articles as $data) {
            $article = \App\Models\Article::create([
                'author_id' => $data['author_id'],
                'category_id' => $data['category_id'],
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'thumbnail' => $data['thumbnail'],
                'body' => $data['body'],
                'status' => 'published',
                'published_at' => now(),
                'is_featured' => false,
            ]);
            $article->tags()->sync($data['tags']);
        }
    }
}
