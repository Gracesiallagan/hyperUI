@extends('layouts.admin')

@section('title', 'Dashboard Admin - GandengTangan')
@section('page_title', 'Dashboard')
@section('page_subtitle', 'Ringkasan data marketplace inklusif')

@section('content')
    <section class="admin-cards">
        <div class="admin-stat">
            <div class="admin-stat-icon">👤</div>
            <div>
                <div class="admin-stat-value">{{ $stats['users'] }}</div>
                <div class="admin-stat-label">Users</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">🏫</div>
            <div>
                <div class="admin-stat-value">{{ $stats['organizations'] }}</div>
                <div class="admin-stat-label">Organizations</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">🎨</div>
            <div>
                <div class="admin-stat-value">{{ $stats['artists'] }}</div>
                <div class="admin-stat-label">Artists</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">🗂️</div>
            <div>
                <div class="admin-stat-value">{{ $stats['categories'] }}</div>
                <div class="admin-stat-label">Categories</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">🛍️</div>
            <div>
                <div class="admin-stat-value">{{ $stats['products'] }}</div>
                <div class="admin-stat-label">Products</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">⭐</div>
            <div>
                <div class="admin-stat-value">{{ $stats['featured_products'] }}</div>
                <div class="admin-stat-label">Featured</div>
            </div>
        </div>

        <div class="admin-stat">
            <div class="admin-stat-icon">✅</div>
            <div>
                <div class="admin-stat-value">{{ $stats['sold_products'] }}</div>
                <div class="admin-stat-label">Sold</div>
            </div>
        </div>
    </section>

    <section class="admin-section">
        <div class="admin-section-head">
            <h2 class="admin-h2">Produk Terbaru</h2>
            <a class="admin-small-link" href="#">Kelola Produk →</a>
        </div>

        <div class="admin-table">
            <div class="admin-table-head">
                <div>Produk</div>
                <div>Kategori</div>
                <div>Artist</div>
                <div>Harga</div>
                <div>Status</div>
            </div>

            @forelse ($latestProducts as $p)
                <div class="admin-table-row">
                    <div class="admin-prod">
                        <div class="admin-prod-thumb">
                            @if($p->image)
                                <img src="{{ asset($p->image) }}" alt="{{ $p->title }}">
                            @else
                                🖼️
                            @endif
                        </div>
                        <div class="admin-prod-meta">
                            <div class="admin-prod-title">{{ $p->title }}</div>
                            <div class="admin-prod-sub">ID: {{ $p->id }} • {{ $p->created_at->format('d M Y') }}</div>
                        </div>
                    </div>

                    <div class="admin-pill">
                        {{ $p->category->name ?? '-' }}
                    </div>

                    <div>{{ $p->artist->name ?? '-' }}</div>

                    <div class="admin-price">
                        Rp {{ number_format($p->price, 0, ',', '.') }}
                    </div>

                    <div class="admin-badges">
                        @if($p->is_featured)
                            <span class="badge badge-featured">Featured</span>
                        @endif
                        @if($p->is_sold)
                            <span class="badge badge-sold">Sold</span>
                        @else
                            <span class="badge badge-available">Available</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="admin-empty">
                    Belum ada produk. Jalankan seeder atau tambahkan produk dari menu Products.
                </div>
            @endforelse
        </div>
    </section>
@endsection