<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\LingkarSosialScraper;
use App\Models\Organization;
use App\Models\Artist;
use App\Models\Product;

class ScrapeProducts extends Command
{
    protected $signature = 'scrape:products';
    protected $description = 'Scrape produk dari Lingkar Sosial dan simpan ke database';

    public function handle()
    {
        $this->info('🔄 Memulai scraping dari Lingkar Sosial...');

        try {
            $scraper = new LingkarSosialScraper();
            $items = $scraper->scrape();

            if (empty($items)) {
                $this->warn('Tidak ada produk yang ditemukan.');
                return 0;
            }

            // Create default organization if not exists
            $org = Organization::firstOrCreate(
                ['name' => 'Lingkar Sosial'],
                ['icon' => '🤝', 'description' => 'Produk dari Lingkar Sosial Indonesia']
            );

            // Create default artist if not exists
            $artist = Artist::firstOrCreate(
                ['name' => 'Seniman Lingkar Sosial', 'organization_id' => $org->id],
                ['disability_type' => 'Teman Daksa', 'avatar' => 'S']
            );

            $count = 0;
            foreach ($items as $item) {
                Product::updateOrCreate(
                    ['title' => $item['title']],
                    [
                        'category'    => $item['category'],
                        'medium'      => $item['medium'],
                        'price'       => $item['price'],
                        'image'       => $item['image'],
                        'description' => $item['description'] ?? null,
                        'artist_id'   => $artist->id,
                    ]
                );
                $count++;
            }

            $this->info("✅ Berhasil mengimpor {$count} produk!");
        } catch (\Exception $e) {
            $this->error('❌ Error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
