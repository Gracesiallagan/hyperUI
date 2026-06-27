<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Category;
use App\Models\Organization;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Legacy compatibility: keep demo data idempotent while schema is still old.
        $orgs = [
            Organization::firstOrCreate(
                ['name' => 'SLB Pembina'],
                ['icon' => '🏫', 'description' => 'Sekolah Luar Biasa Pembina']
            ),
            Organization::firstOrCreate(
                ['name' => 'Yayasan Kasih'],
                ['icon' => '🤝', 'description' => 'Yayasan Kasih untuk Disabilitas']
            ),
            Organization::firstOrCreate(
                ['name' => 'Komunitas Seni'],
                ['icon' => '🎨', 'description' => 'Komunitas Seni Inklusif']
            ),
            Organization::firstOrCreate(
                ['name' => 'SLB Dharma'],
                ['icon' => '📚', 'description' => 'Sekolah Luar Biasa Dharma']
            ),
            Organization::firstOrCreate(
                ['name' => 'Sanggar Lukis'],
                ['icon' => '🖌️', 'description' => 'Sanggar Lukis Pelangi']
            ),
        ];

        $categories = [
            'Lukisan' => Category::updateOrCreate(
                ['slug' => 'lukisan'],
                ['name' => 'Lukisan', 'icon' => '🖌️']
            ),
            'Digital Art' => Category::updateOrCreate(
                ['slug' => 'digital-art'],
                ['name' => 'Digital Art', 'icon' => '💻']
            ),
            'Kriya' => Category::updateOrCreate(
                ['slug' => 'kriya'],
                ['name' => 'Kriya', 'icon' => '🏺']
            ),
            'Tekstil' => Category::updateOrCreate(
                ['slug' => 'tekstil'],
                ['name' => 'Tekstil', 'icon' => '🧵']
            ),
        ];

        $artists = [
            Artist::firstOrCreate(
                ['name' => 'Risky', 'organization_id' => $orgs[0]->id],
                ['avatar' => 'R', 'disability_type' => 'Teman Tuli']
            ),
            Artist::firstOrCreate(
                ['name' => 'Siti', 'organization_id' => $orgs[1]->id],
                ['avatar' => 'S', 'disability_type' => 'Teman Netra']
            ),
            Artist::firstOrCreate(
                ['name' => 'Budi', 'organization_id' => $orgs[2]->id],
                ['avatar' => 'B', 'disability_type' => 'Teman Autis']
            ),
            Artist::firstOrCreate(
                ['name' => 'Yudi', 'organization_id' => $orgs[3]->id],
                ['avatar' => 'Y', 'disability_type' => 'Teman Grahita']
            ),
            Artist::firstOrCreate(
                ['name' => 'Adi', 'organization_id' => $orgs[4]->id],
                ['avatar' => 'A', 'disability_type' => 'Teman Daksa']
            ),
            Artist::firstOrCreate(
                ['name' => 'Raka', 'organization_id' => $orgs[0]->id],
                ['avatar' => 'R', 'disability_type' => 'Teman Tuli']
            ),
        ];

        $products = [
            ['title' => 'Senja di Jakarta', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Akrilik di Kanvas', 'price' => 500000, 'artist_id' => $artists[0]->id, 'is_featured' => true],
            ['title' => 'Samudra Mimpi', 'category_id' => $categories['Digital Art']->id, 'medium' => 'High-Res Print', 'price' => 350000, 'artist_id' => $artists[1]->id, 'is_featured' => true],
            ['title' => 'Vas Bunga Harapan', 'category_id' => $categories['Kriya']->id, 'medium' => 'Tanah Liat & Glaze', 'price' => 150000, 'artist_id' => $artists[2]->id, 'is_featured' => true],
            ['title' => 'Tenun Harapan', 'category_id' => $categories['Tekstil']->id, 'medium' => 'Tekstil Tradisional', 'price' => 250000, 'artist_id' => $artists[3]->id, 'is_featured' => true],
            ['title' => 'Gunung Damai', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Cat Air', 'price' => 750000, 'artist_id' => $artists[4]->id],
            ['title' => 'Mimpi Berwarna', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Cat Air di Kanvas', 'price' => 400000, 'artist_id' => $artists[5]->id, 'is_sold' => true],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['title' => $product['title'], 'artist_id' => $product['artist_id']],
                $product
            );
        }

        User::updateOrCreate(
            ['email' => 'admin@gandengtangan.id'],
            [
                'name' => 'Admin GandengTangan',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'organization_id' => null,
            ]
        );
    }
}
