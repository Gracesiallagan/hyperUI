<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class CartController extends Controller
{
    public function index()
    {
        $ids = session('cart.products', []);
        $products = Product::with(['artist', 'category'])
            ->whereIn('id', $ids)
            ->get()
            ->sortBy(fn ($product) => array_search($product->id, $ids))
            ->values();

        $waNumber = $this->whatsappNumber();
        $waLink = $products->isEmpty() ? null : 'https://wa.me/'.$waNumber.'?text='.urlencode($this->bulkMessage($products));

        return view('public.cart', compact('products', 'waLink'));
    }

    public function store(Product $product)
    {
        $ids = session('cart.products', []);

        if (! in_array($product->id, $ids)) {
            $ids[] = $product->id;
        }

        session(['cart.products' => $ids]);

        return back()->with('success', 'Produk berhasil disimpan ke keranjang.');
    }

    public function destroy(Product $product)
    {
        $ids = array_values(array_filter(session('cart.products', []), fn ($id) => (int) $id !== (int) $product->id));
        session(['cart.products' => $ids]);

        return back()->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart.products');

        return back()->with('success', 'Keranjang dikosongkan.');
    }

    private function whatsappNumber(): string
    {
        $setting = Schema::hasTable('settings') ? Setting::query()->first() : null;
        $number = optional($setting)->whatsapp_number ?: config('whatsapp.admin_number', '6281361428113');
        $number = preg_replace('/\D+/', '', $number);

        return str_starts_with($number, '0') ? '62'.substr($number, 1) : $number;
    }

    private function bulkMessage($products): string
    {
        $lines = [
            'Halo Admin GandengTangan, saya tertarik dengan beberapa produk berikut:',
            '',
        ];

        foreach ($products as $index => $product) {
            $lines[] = ($index + 1).'. '.$product->title;
            $lines[] = 'Harga: '.$product->formatted_price;
            $lines[] = 'Pengrajin: '.($product->artist->name ?? '-');
            $lines[] = 'Status: '.($product->is_sold ? 'Sold Out' : 'Tersedia');
            if (! $product->is_sold) {
                $lines[] = 'Stok: '.(int) ($product->stock ?? 0);
            }
            $lines[] = '';
        }

        $lines[] = 'Saya ingin bertanya atau melakukan pemesanan produk tersebut.';

        return implode("\n", $lines);
    }
}
