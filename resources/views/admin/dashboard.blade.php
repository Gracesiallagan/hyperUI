@extends('layouts.admin')

@section('title', 'Dashboard Admin - GandengTangan')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan data katalog MVP')

@section('content')
    <section class="admin-cards">
        <div class="admin-stat"><div class="admin-stat-icon">📦</div><div><div class="admin-stat-value">{{ $stats['products'] }}</div><div class="admin-stat-label">Total Produk</div></div></div>
        <div class="admin-stat"><div class="admin-stat-icon">✅</div><div><div class="admin-stat-value">{{ $stats['available_products'] }}</div><div class="admin-stat-label">Produk Tersedia</div></div></div>
        <div class="admin-stat"><div class="admin-stat-icon">⛔</div><div><div class="admin-stat-value">{{ $stats['sold_products'] }}</div><div class="admin-stat-label">Sold Out</div></div></div>
        <div class="admin-stat"><div class="admin-stat-icon">🧡</div><div><div class="admin-stat-value">{{ $stats['artists'] }}</div><div class="admin-stat-label">Pengrajin</div></div></div>
        <div class="admin-stat"><div class="admin-stat-icon">🏷️</div><div><div class="admin-stat-value">{{ $stats['categories'] }}</div><div class="admin-stat-label">Kategori</div></div></div>
    </section>

    <section class="admin-grid-2">
        <div class="admin-panel">
            <div class="admin-panel-head">
                <h2 class="admin-h2">Produk Terbaru</h2>
                <a class="admin-small-link" href="{{ route('admin.products.index') }}">Kelola Produk</a>
            </div>

            <div class="admin-table">
                <div class="admin-table-head">
                    <div>Produk</div>
                    <div>Kategori</div>
                    <div>Pengrajin</div>
                    <div>Harga</div>
                    <div>Status</div>
                </div>

                @forelse ($latestProducts as $p)
                    <div class="admin-table-row">
                        <div class="admin-prod">
                            <div class="admin-prod-thumb">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->title }}">
                                @else
                                    IMG
                                @endif
                            </div>
                            <div class="admin-prod-meta">
                                <div class="admin-prod-title">{{ $p->title }}</div>
                                <div class="admin-prod-sub">ID: {{ $p->id }} • {{ $p->created_at->format('d M Y') }}</div>
                            </div>
                        </div>

                        <div class="admin-pill">{{ $p->category->name ?? '-' }}</div>
                        <div>{{ $p->artist->name ?? '-' }}</div>
                        <div class="admin-price">Rp {{ number_format($p->price, 0, ',', '.') }}</div>

                        <div class="admin-badges">
                            @if($p->is_featured)
                                <span class="badge badge-featured">Featured</span>
                            @endif

                            @if($p->is_sold)
                                <span class="badge badge-sold">Sold Out</span>
                            @else
                                <span class="badge badge-available">Tersedia</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="admin-empty">Belum ada produk.</div>
                @endforelse
            </div>
        </div>

        <div class="admin-panel">
            <div class="admin-panel-head">
                <h2 class="admin-h2">Pengrajin Terbaru</h2>
                <a class="admin-small-link" href="{{ route('admin.artists.index') }}">Kelola Pengrajin</a>
            </div>

            <div class="admin-list">
                @forelse ($latestArtists as $a)
                    <div class="admin-list-item">
                        <div class="admin-list-avatar">
                            {{ $a->avatar ?: strtoupper(substr($a->name, 0, 1)) }}
                        </div>
                        <div class="admin-list-meta">
                            <div class="admin-list-title">{{ $a->name }}</div>
                            <div class="admin-list-sub">
                                {{ $a->disability_type }} • {{ $a->products_count }} produk
                            </div>
                        </div>
                        <a class="admin-mini-btn" href="{{ route('admin.artists.edit', $a) }}">Edit</a>
                    </div>
                @empty
                    <div class="admin-empty">Belum ada pengrajin.</div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
