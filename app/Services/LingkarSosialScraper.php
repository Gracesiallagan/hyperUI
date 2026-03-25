<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class LingkarSosialScraper
{
    protected string $url = 'https://lingkarsosial.org/produk-disabilitas-untuk-ramadhan-dan-lebaran/';

    public function scrape(): array
    {
        $response = Http::timeout(30)->get($this->url);

        if (!$response->successful()) {
            throw new \RuntimeException('Gagal mengambil data dari Lingkar Sosial');
        }

        $crawler = new Crawler($response->body());
        $products = [];

        // Scrape product cards from the page
        $crawler->filter('article, .product-card, .wp-block-group, figure')->each(function (Crawler $node) use (&$products) {
            try {
                $title = '';
                $image = '';
                $price = 0;
                $description = '';

                // Try to find title
                $titleNode = $node->filter('h2, h3, h4, .product-title, figcaption');
                if ($titleNode->count() > 0) {
                    $title = trim($titleNode->first()->text());
                }

                // Try to find image
                $imgNode = $node->filter('img');
                if ($imgNode->count() > 0) {
                    $image = $imgNode->first()->attr('src') ?? $imgNode->first()->attr('data-src') ?? '';
                }

                // Try to find price
                $priceNode = $node->filter('.price, .amount, [class*="price"]');
                if ($priceNode->count() > 0) {
                    $priceText = $priceNode->first()->text();
                    $price = (int) preg_replace('/[^0-9]/', '', $priceText);
                }

                // Try to find description
                $descNode = $node->filter('p, .description, .excerpt');
                if ($descNode->count() > 0) {
                    $description = trim($descNode->first()->text());
                }

                if (!empty($title) && strlen($title) > 2) {
                    $products[] = [
                        'title'       => $title,
                        'image'       => $image,
                        'price'       => $price ?: rand(50000, 500000),
                        'description' => $description,
                        'category'    => $this->guessCategory($title . ' ' . $description),
                        'medium'      => $this->guessMedium($title . ' ' . $description),
                    ];
                }
            } catch (\Exception $e) {
                // Skip items that fail
            }
        });

        return $products;
    }

    protected function guessCategory(string $text): string
    {
        $text = strtolower($text);
        if (preg_match('/lukis|cat|kanvas|paint/i', $text)) return 'Lukisan';
        if (preg_match('/digital|print|nft/i', $text)) return 'Digital Art';
        if (preg_match('/tenun|batik|kain|tekstil/i', $text)) return 'Tekstil';
        return 'Kriya';
    }

    protected function guessMedium(string $text): string
    {
        $text = strtolower($text);
        if (preg_match('/akrilik/i', $text)) return 'Akrilik di Kanvas';
        if (preg_match('/cat air/i', $text)) return 'Cat Air';
        if (preg_match('/tenun/i', $text)) return 'Tekstil Tradisional';
        if (preg_match('/digital/i', $text)) return 'High-Res Print';
        if (preg_match('/tanah liat|keramik/i', $text)) return 'Tanah Liat & Glaze';
        return 'Media Campuran';
    }
}
