<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\HeroSlide;
use App\Models\Attraction;
use App\Models\TourPackage;
use App\Models\Product;
use App\Models\Article;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class DemoDataSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Create images directory
        Storage::disk('public')->makeDirectory('seed_images');

        $this->command->info('Mulai melakukan seeding data demo...');

        // 1. Seed Settings
        Setting::updateOrCreate(
            ['key' => 'whatsapp_number'],
            ['value' => '6281234567890', 'type' => 'text']
        );
        $this->command->info('Berhasil memuat Settings');

        // 2. Seed Hero Slide
        $heroImageContent = @file_get_contents('https://loremflickr.com/1280/720/village,nature,landscape');
        if ($heroImageContent) {
            $heroImageName = 'seed_images/hero_' . Str::random(10) . '.jpg';
            Storage::disk('public')->put($heroImageName, $heroImageContent);
            
            HeroSlide::create([
                'title' => 'Selamat Datang di Lembur Sawah',
                'subtitle' => 'Temukan keindahan alam dan rasakan ketenangan pedesaan yang asri.',
                'image' => $heroImageName,
                'button_text' => 'Jelajahi Sekarang',
                'button_link' => '/destinations',
                'is_active' => true,
                'sort_order' => 1
            ]);
            $this->command->info('Berhasil memuat Hero Slide');
        }

        // 3. Seed Attractions (Destinasi)
        $categories = ['Curug', 'Sawah', 'Bukit'];
        for ($i = 0; $i < 3; $i++) {
            $img = @file_get_contents('https://loremflickr.com/800/600/waterfall,ricefield,hill?lock=' . rand(1, 1000));
            $imgPath = null;
            if ($img) {
                $imgPath = 'seed_images/attraction_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($imgPath, $img);
            }

            Attraction::create([
                'name' => 'Wisata Alam ' . $faker->city,
                'category' => $categories[$i],
                'difficulty' => 'Mudah',
                'description' => '<p>' . implode('</p><p>', $faker->paragraphs(3)) . '</p>',
                'image' => $imgPath,
            ]);
        }
        $this->command->info('Berhasil memuat Destinasi Wisata');

        // 4. Seed Tour Packages
        for ($i = 0; $i < 3; $i++) {
            $img = @file_get_contents('https://loremflickr.com/800/600/tourist,travel,village?lock=' . rand(1, 1000));
            $imgPath = null;
            if ($img) {
                $imgPath = 'seed_images/package_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($imgPath, $img);
            }

            TourPackage::create([
                'name' => 'Paket Edukasi ' . $faker->word,
                'slug' => Str::slug('Paket Edukasi ' . $faker->word . ' ' . Str::random(5)),
                'description' => '<p>' . implode('</p><p>', $faker->paragraphs(2)) . '</p>',
                'price' => $faker->numberBetween(150000, 500000),
                'duration' => rand(1, 3) . ' Hari',
                'max_pax' => rand(5, 20),
                'is_popular' => true,
                'image' => $imgPath,
            ]);
        }
        $this->command->info('Berhasil memuat Paket Tour');

        // 5. Seed Products (Market)
        for ($i = 0; $i < 3; $i++) {
            $img = @file_get_contents('https://loremflickr.com/800/600/handicraft,food,traditional?lock=' . rand(1, 1000));
            $imgPath = null;
            if ($img) {
                $imgPath = 'seed_images/product_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($imgPath, $img);
            }

            Product::create([
                'name' => 'Kerajinan ' . $faker->word,
                'slug' => Str::slug('Kerajinan ' . $faker->word . ' ' . Str::random(5)),
                'category' => 'Souvenir',
                'description' => '<p>' . implode('</p><p>', $faker->paragraphs(2)) . '</p>',
                'price' => $faker->numberBetween(25000, 150000),
                'is_featured' => true,
                'image' => $imgPath,
            ]);
        }
        $this->command->info('Berhasil memuat Produk Market');

        // 6. Seed Articles
        for ($i = 0; $i < 3; $i++) {
            $img = @file_get_contents('https://loremflickr.com/800/600/news,village,people?lock=' . rand(1, 1000));
            $imgPath = null;
            if ($img) {
                $imgPath = 'seed_images/article_' . Str::random(10) . '.jpg';
                Storage::disk('public')->put($imgPath, $img);
            }

            Article::create([
                'title' => $faker->sentence(6),
                'slug' => Str::slug($faker->sentence(6) . ' ' . Str::random(5)),
                'category' => 'Berita Desa',
                'content' => '<p>' . implode('</p><p>', $faker->paragraphs(4)) . '</p>',
                'is_published' => true,
                'is_featured' => true,
                'image' => $imgPath,
                'published_at' => now(),
            ]);
        }
        $this->command->info('Berhasil memuat Artikel');
        
        $this->command->info('Seeding data selesai! Silakan muat ulang (refresh) halaman website.');
    }
}
