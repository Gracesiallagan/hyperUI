@extends('layouts.app')

@section('title', 'Catalog - GandengTangan')

@section('content')
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Catalog</h1>
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
                $waNumber = config('whatsapp.number');

                $message = trim(config('whatsapp.default_text'))."\n"
                    ."Judul: {$p->title}\n"
                    ."Harga: Rp ".number_format((int)$p->price, 0, ',', '.')."\n"
                    ."Pengrajin: ".($p->artist->name ?? '-')."\n"
                    ."Link: ".route('product.show', $p);

                $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);
            @endphp

            <div class="card artwork-card">
                <a class="artwork-media" href="{{ route('product.show', $p) }}">
                    @if($p->image)
                        <img src="{{ str_starts_with($p->image, 'http') ? $p->image : asset('storage/'.$p->image) }}" alt="{{ $p->title }}">
                    @else
                        <div class="artwork-placeholder">IMG</div>
                    @endif
                </a>

                <div class="artwork-body">
                    <div class="artwork-top">
                        <div class="artwork-title">{{ $p->title }}</div>
                        <div class="artwork-price">Rp {{ number_format((int)$p->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="artwork-meta">
                        <span class="pill">{{ $p->category->name ?? '-' }}</span>
                        <span class="muted">{{ $p->artist->name ?? '-' }}</span>
                    </div>

                    <div class="artwork-actions">
                        <a class="btn btn-ghost" href="{{ route('product.show', $p) }}">Detail</a>
                        <a class="btn btn-dark" href="{{ $waLink }}" target="_blank" rel="noreferrer">
                            Beli / Pesan
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
