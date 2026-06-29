@extends('layouts.app')

@section('title', 'Keranjang - GandengTangan')

@section('content')
@php
    $setting = \Illuminate\Support\Facades\Schema::hasTable('settings') ? \App\Models\Setting::query()->first() : null;
    $waNumber = preg_replace('/\D+/', '', optional($setting)->whatsapp_number ?: config('whatsapp.admin_number', '6281361428113'));
    if (str_starts_with($waNumber, '0')) $waNumber = '62'.substr($waNumber, 1);
    $isLocalUrl = str_contains(config('app.url'), '127.0.0.1') || str_contains(config('app.url'), 'localhost');
@endphp
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Produk yang Anda Simpan</h1>
            <p class="page-subtitle">Simpan beberapa produk terlebih dahulu, lalu hubungi admin saat siap bertanya atau memesan.</p>
        </div>
    </div>

    @if($products->isEmpty())
        <div class="empty-cart card">
            <div class="empty-icon">🛒</div>
            <h2>Belum ada produk yang disimpan.</h2>
            <p>Mulai pilih produk dari katalog dan simpan ke keranjang minat.</p>
            <a class="btn btn-primary" href="{{ route('catalog') }}">Lanjut Lihat Katalog</a>
        </div>
    @else
        <div class="cart-list">
            @foreach($products as $product)
                @php
                    $artistName = $product->artist->name ?? '-';
                    $message = $product->is_sold
                        ? "Halo Admin GandengTangan, saya ingin bertanya ketersediaan produk berikut:\n\nProduk: {$product->title}\nHarga: {$product->formatted_price}\nPengrajin: {$artistName}\nStatus: Sold Out\n\nApakah produk ini masih bisa dipesan kembali?"
                        : "Halo Admin GandengTangan, saya tertarik dengan produk berikut:\n\nProduk: {$product->title}\nHarga: {$product->formatted_price}\nPengrajin: {$artistName}\nStatus: Tersedia\nStok: ".(int)($product->stock ?? 1)."\n\nSaya ingin bertanya atau melakukan pemesanan produk ini.";
                    if (! $isLocalUrl) $message .= "\n\nHalaman Produk: ".route('product.show', $product);
                @endphp
                <div class="card cart-item">
                    <a class="cart-thumb" href="{{ route('product.show', $product) }}">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                        @else
                            <span>IMG</span>
                        @endif
                    </a>
                    <div class="cart-info">
                        <div class="cart-title">{{ $product->title }}</div>
                        <div class="cart-meta">{{ $artistName }} • {{ $product->category->name ?? '-' }}</div>
                        <div class="cart-price">{{ $product->formatted_price }}</div>
                        <div class="admin-badges">
                            @if($product->is_sold)
                                <span class="badge badge-sold">🔴 Sold Out</span>
                            @else
                                <span class="badge badge-available">🟢 Tersedia</span>
                                <span class="status-stock">Stok: {{ (int) ($product->stock ?? 1) }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="cart-actions">
                        <a class="btn btn-primary" href="https://wa.me/{{ $waNumber }}?text={{ urlencode($message) }}" target="_blank" rel="noreferrer">
                            {{ $product->is_sold ? 'Tanya Ketersediaan' : 'Pesan via WhatsApp' }}
                        </a>
                        <form method="POST" action="{{ route('cart.destroy', $product) }}" data-confirm-submit data-confirm-title="Hapus dari Keranjang?" data-confirm-message="Produk ini akan dihapus dari daftar simpanan Anda.">
                            @csrf
                            @method('DELETE')
                            <button class="cart-delete-btn" type="submit" title="Hapus dari Keranjang" aria-label="Hapus dari Keranjang">🗑</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <form method="POST" action="{{ route('cart.clear') }}" class="cart-clear" data-confirm-submit data-confirm-title="Kosongkan Keranjang?" data-confirm-message="Semua produk yang disimpan akan dihapus dari keranjang.">
            @csrf
            @method('DELETE')
            <button class="btn btn-ghost" type="submit">Kosongkan Keranjang</button>
        </form>
    @endif
</div>
@endsection
