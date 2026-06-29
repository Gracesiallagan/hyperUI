@extends('layouts.app')

@section('title', 'Katalog - GandengTangan')

@section('content')
<div class="container page">
    @php
        $waSetting = \Illuminate\Support\Facades\Schema::hasTable('settings') ? \App\Models\Setting::query()->first() : null;
        $waNumber = optional($waSetting)->whatsapp_number ?: config('whatsapp.admin_number', '6281361428113');
        $waNumber = preg_replace('/\D+/', '', $waNumber);
        if (str_starts_with($waNumber, '0')) $waNumber = '62'.substr($waNumber, 1);
    @endphp

    <div class="gallery-head">
        <div>
            <h1 class="page-title">Katalog Produk</h1>
            <p class="page-subtitle">Temukan produk pilihan dari para pengrajin disabilitas.</p>
        </div>
    </div>

    <form class="gallery-filters" method="GET" action="{{ route('catalog') }}">
        <div class="filter">
            <label class="filter-label" for="search">Search</label>
            <input id="search" class="filter-input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama produk / pengrajin...">
        </div>

        <div class="filter">
            <label class="filter-label" for="category">Kategori</label>
            <select id="category" class="filter-input" name="category">
                <option value="Semua" {{ request('category', 'Semua') === 'Semua' ? 'selected' : '' }}>Semua</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug ?? $cat->name }}"
                        {{ request('category') === ($cat->slug ?? $cat->name) ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="filter">
            <label class="filter-label" for="type">Tipe</label>
            <select id="type" class="filter-input" name="type">
                <option value="" {{ request('type') ? '' : 'selected' }}>Semua</option>
                @foreach($types as $t)
                    <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ $t }}</option>
                @endforeach
            </select>
        </div>

        <div class="filter-actions">
            <button class="btn btn-primary" type="submit">Terapkan</button>
            <a class="btn btn-ghost" href="{{ route('catalog') }}">Reset</a>
        </div>
    </form>

    <div class="gallery-grid">
        @forelse($products as $p)
            @php
                $defaultText = config('whatsapp.default_text', 'Halo admin GandengTangan, saya tertarik dengan produk ini.');

                $message = trim($defaultText)."\n"
                    ."Judul: {$p->title}\n"
                    ."Harga: Rp ".number_format((int)$p->price, 0, ',', '.')."\n"
                    ."Pengrajin: ".($p->artist->name ?? '-')."\n"
                    ."Status: ".($p->is_sold ? 'Sold Out' : 'Tersedia (stok: '.(int)($p->stock ?? 1).')')."\n"
                    ."Link: ".route('product.show', $p);

                $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
            @endphp

            <div class="card artwork-card">
                <a class="artwork-media" href="{{ route('product.show', $p) }}">
                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->title }}">
                    @else
                        <div class="artwork-placeholder">IMG</div>
                    @endif
                </a>

                <div class="artwork-body">
                    <div class="artwork-top">
                        <div class="artwork-title">{{ $p->title }}</div>
                        <div class="artwork-price">Rp {{ number_format((int)$p->price, 0, ',', '.') }}</div>
                    </div>

                    @if($p->is_sold)
                        <div class="artwork-status"><span class="badge badge-sold">Sold Out</span></div>
                    @endif

                    <div class="artwork-meta">
                        <span class="pill">{{ $p->category->name ?? '-' }}</span>
                        <span class="muted">{{ $p->artist->name ?? '-' }}</span>
                    </div>

                    <div class="artwork-actions">
                        <a class="btn btn-ghost" href="{{ route('product.show', $p) }}">Detail</a>
                        <a class="btn btn-dark" href="{{ $waLink }}" target="_blank" rel="noreferrer">
                            {{ $p->is_sold ? 'Tanya Ketersediaan' : 'Beli via WhatsApp' }}
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="empty-state">
                Belum ada produk yang tersedia.
            </div>
        @endforelse
    </div>

    <div class="pagination-wrap">
        {{ $products->withQueryString()->links() }}
    </div>
</div>
@endsection
