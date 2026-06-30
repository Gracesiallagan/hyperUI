@extends('layouts.app')
@section('title', $product->title . ' - GandengTangan')

@section('content')
@php
    $waSetting = \Illuminate\Support\Facades\Schema::hasTable('settings') ? \App\Models\Setting::query()->first() : null;
    $waNumber = optional($waSetting)->whatsapp_number ?: config('whatsapp.admin_number', '6281361428113');
    $waNumber = preg_replace('/\D+/', '', $waNumber);
    if (str_starts_with($waNumber, '0')) $waNumber = '62'.substr($waNumber, 1);
    $artistName = $product->artist->name ?? '-';
    $isLocalUrl = str_contains(config('app.url'), '127.0.0.1') || str_contains(config('app.url'), 'localhost');
    $waMessage = $product->is_sold
        ? "Halo Admin GandengTangan, saya ingin bertanya ketersediaan produk berikut:\n\nProduk: {$product->title}\nHarga: {$product->formatted_price}\nPengrajin: {$artistName}\nStatus: Sold Out\n\nApakah produk ini masih bisa dipesan kembali?"
        : "Halo Admin GandengTangan, saya tertarik dengan produk berikut:\n\nProduk: {$product->title}\nHarga: {$product->formatted_price}\nPengrajin: {$artistName}\nStatus: Tersedia\nStok: ".(int)($product->stock ?? 1)."\n\nSaya ingin bertanya atau melakukan pemesanan produk ini.";
    if (! $isLocalUrl) {
        $waMessage .= "\n\nHalaman Produk: ".route('product.show', $product);
    }
@endphp

<div class="container page">
    <a href="{{ route('catalog') }}" class="back-link">&larr; Kembali ke Katalog</a>

    <section class="detail-grid">
        <div>
            <div class="detail-media">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" alt="{{ $product->title }}">
                @else
                    <div class="detail-placeholder">IMG</div>
                @endif
            </div>
            <div class="detail-thumbs">
                <div class="detail-thumb active">
                    @if($product->image_url)
                        <img src="{{ $product->image_url }}" alt="Thumbnail {{ $product->title }}">
                    @else
                        <span>IMG</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="detail-info">
            <div class="detail-badges">
                <span class="pill">{{ $product->category->name ?? '-' }}</span>
                @if($product->is_sold)
                    <span class="badge badge-sold">Sold Out</span>
                @else
                    <span class="badge badge-featured">Tersedia</span>
                @endif
            </div>

            <h1 class="detail-title">{{ $product->title }}</h1>
            <p class="detail-medium">{{ $product->medium ?: 'Produk karya pengrajin' }}</p>
            <div class="detail-price">{{ $product->formatted_price }}</div>

            <div class="detail-stock">Stok: {{ (int) ($product->stock ?? ($product->is_sold ? 0 : 1)) }}</div>

            @if($product->description)
                <p class="detail-description">{{ $product->description }}</p>
            @endif

            <div class="maker-card">
                <div class="maker-avatar">{{ $product->artist->avatar ?? strtoupper(substr($artistName, 0, 1)) }}</div>
                <div>
                    <div class="maker-label">Pengrajin</div>
                    <div class="maker-name">{{ $artistName }}</div>
                    <div class="maker-sub">{{ $product->artist->disability_type ?? '-' }}</div>
                </div>
            </div>

            <div class="detail-actions">
                <form method="POST" action="{{ route('cart.store', $product) }}">
                    @csrf
                    <button class="btn btn-ghost detail-wa" type="submit">🛒 Simpan ke Keranjang</button>
                </form>
                <a href="https://wa.me/{{ $waNumber }}?text={{ urlencode($waMessage) }}"
                   target="_blank"
                   rel="noreferrer"
                   class="btn btn-primary detail-wa">
                    {{ $product->is_sold ? 'Tanya Ketersediaan' : 'Beli via WhatsApp' }}
                </a>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="card artisan-section">
            <div class="maker-avatar big">{{ $product->artist->avatar ?? strtoupper(substr($artistName, 0, 1)) }}</div>
            <div>
                <h2>Tentang Pengrajin</h2>
                <h3>{{ $artistName }}</h3>
                <p>{{ $product->artist->bio ?: 'Pengrajin GandengTangan yang menghasilkan karya dengan detail dan ketekunan.' }}</p>
                <span class="pill">{{ $product->artist->disability_type ?? 'Pengrajin' }}</span>
            </div>
        </div>
    </section>

    @if($related->count() > 0)
        <section class="section">
            <div class="section-head">
                <div>
                    <h2 class="section-title">Produk Serupa</h2>
                    <p class="section-subtitle">Rekomendasi dari kategori yang sama.</p>
                </div>
            </div>
            <div class="home-products">
                @foreach($related as $p)
                    @include('components.product-card', ['product' => $p])
                @endforeach
            </div>
        </section>
    @endif
</div>
@endsection
