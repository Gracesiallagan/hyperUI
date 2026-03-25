<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;
use App\Models\Artist;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Organizations
        $orgs = [
            Organization::create(['name' => 'SLB Pembina', 'icon' => '🏫', 'description' => 'Sekolah Luar Biasa Pembina']),
            Organization::create(['name' => 'Yayasan Kasih', 'icon' => '🤝', 'description' => 'Yayasan Kasih untuk Disabilitas']),
            Organization::create(['name' => 'Komunitas Seni', 'icon' => '🎨', 'description' => 'Komunitas Seni Inklusif']),
            Organization::create(['name' => 'SLB Dharma', 'icon' => '📚', 'description' => 'Sekolah Luar Biasa Dharma']),
            Organization::create(['name' => 'Sanggar Lukis', 'icon' => '🖌️', 'description' => 'Sanggar Lukis Pelangi']),
        ];

        // Categories (baru)
        $categories = [
            'Lukisan'     => Category::create(['name' => 'Lukisan', 'slug' => 'lukisan', 'icon' => '🖌️']),
            'Digital Art' => Category::create(['name' => 'Digital Art', 'slug' => 'digital-art', 'icon' => '💻']),
            'Kriya'       => Category::create(['name' => 'Kriya', 'slug' => 'kriya', 'icon' => '🏺']),
            'Tekstil'     => Category::create(['name' => 'Tekstil', 'slug' => 'tekstil', 'icon' => '🧵']),
        ];

        // Artists
        $artists = [
            Artist::create(['name' => 'Risky', 'avatar' => 'R', 'disability_type' => 'Teman Tuli', 'organization_id' => $orgs[0]->id]),
            Artist::create(['name' => 'Siti', 'avatar' => 'S', 'disability_type' => 'Teman Netra', 'organization_id' => $orgs[1]->id]),
            Artist::create(['name' => 'Budi', 'avatar' => 'B', 'disability_type' => 'Teman Autis', 'organization_id' => $orgs[2]->id]),
            Artist::create(['name' => 'Yudi', 'avatar' => 'Y', 'disability_type' => 'Teman Grahita', 'organization_id' => $orgs[3]->id]),
            Artist::create(['name' => 'Adi', 'avatar' => 'A', 'disability_type' => 'Teman Daksa', 'organization_id' => $orgs[4]->id]),
            Artist::create(['name' => 'Raka', 'avatar' => 'R', 'disability_type' => 'Teman Tuli', 'organization_id' => $orgs[0]->id]),
        ];

        // Products (pakai category_id, bukan category string)
        $products = [
            ['title' => 'Senja di Jakarta', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Akrilik di Kanvas', 'price' => 500000, 'artist_id' => $artists[0]->id, 'is_featured' => true],
            ['title' => 'Samudra Mimpi', 'category_id' => $categories['Digital Art']->id, 'medium' => 'High-Res Print', 'price' => 350000, 'artist_id' => $artists[1]->id, 'is_featured' => true],
            ['title' => 'Vas Bunga Harapan', 'category_id' => $categories['Kriya']->id, 'medium' => 'Tanah Liat & Glaze', 'price' => 150000, 'artist_id' => $artists[2]->id, 'is_featured' => true],
            ['title' => 'Tenun Harapan', 'category_id' => $categories['Tekstil']->id, 'medium' => 'Tekstil Tradisional', 'price' => 250000, 'artist_id' => $artists[3]->id, 'is_featured' => true],
            ['title' => 'Gunung Damai', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Cat Air', 'price' => 750000, 'artist_id' => $artists[4]->id],
            ['title' => 'Mimpi Berwarna', 'category_id' => $categories['Lukisan']->id, 'medium' => 'Cat Air di Kanvas', 'price' => 400000, 'artist_id' => $artists[5]->id, 'is_sold' => true],
        ];

        foreach ($products as $p) {
            Product::create($p);
        }

        // Admin users
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@gandengtangan.id',
            'password' => Hash::make('password'),
            // NOTE: pastikan kolom 'role' dan 'organization_id' memang ada di tabel users
            'role' => 'super_admin',
            'organization_id' => null,
        ]);

        User::create([
            'name' => 'Admin SLB Pembina',
            'email' => 'pembina@gandengtangan.id',
            'password' => Hash::make('password'),
            'role' => 'org_admin',
            'organization_id' => $orgs[0]->id,
        ]);
    }
}