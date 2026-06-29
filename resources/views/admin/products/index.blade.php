@extends('layouts.admin')
@section('title', 'Kelola Produk')
@section('page_title', 'Kelola Produk')
@section('page_subtitle', 'Tambah, edit, dan kelola status produk')

@section('content')
    <div class="admin-page-actions compact-actions">
        <form class="admin-filter-form" method="GET" action="{{ route('admin.products.index') }}">
            <input class="input" type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk atau pengrajin...">
            <select class="input" name="category">
                <option value="">Semua kategori</option>
                @foreach($categories ?? [] as $cat)
                    <option value="{{ $cat->id }}" {{ (string)request('category') === (string)$cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            <select class="input" name="status">
                <option value="">Semua status</option>
                <option value="available" {{ request('status') === 'available' ? 'selected' : '' }}>Tersedia</option>
                <option value="sold" {{ request('status') === 'sold' ? 'selected' : '' }}>Sold Out</option>
            </select>
            <button class="btn btn-ghost" type="submit">Filter</button>
        </form>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tambah Produk</a>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-head">
            <h2 class="admin-h2">Daftar Produk</h2>
            <div class="admin-muted">
                Total: {{ $products->total() }}
            </div>
        </div>

        <div class="admin-table admin-table-scroll">
            <div class="admin-table-head admin-table-head-6">
                <div>Produk</div>
                <div>Kategori</div>
                <div>Harga</div>
                <div>Pengrajin</div>
                <div>Status</div>
                <div>Aksi</div>
            </div>

            @forelse($products as $product)
                <div class="admin-table-row admin-table-row-6">
                    <div class="admin-prod">
                        <div class="admin-prod-thumb">
                            @if($product->image_url)
                                <img
                                    src="{{ $product->image_url }}"
                                    alt="{{ $product->title }}"
                                >
                            @else
                                🖼️
                            @endif
                        </div>

                        <div class="admin-prod-meta">
                            <div class="admin-prod-title">{{ $product->title }}</div>
                            <div class="admin-prod-sub">
                                ID: {{ $product->id }}
                                @if($product->created_at)
                                    • {{ $product->created_at->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="admin-pill">
                        {{ $product->category->name ?? '-' }}
                    </div>

                    <div class="admin-price">
                        @if(isset($product->formatted_price))
                            {{ $product->formatted_price }}
                        @else
                            Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}
                        @endif
                    </div>

                    <div class="admin-muted">
                        {{ $product->artist->name ?? '-' }}
                    </div>

                    <div class="admin-badges">
                        @if($product->is_featured)
                            <span class="badge badge-featured">Produk Unggulan</span>
                        @endif
                        <span class="status-stock">Stok: {{ (int) ($product->stock ?? ($product->is_sold ? 0 : 1)) }}</span>
                        @if($product->is_sold)
                            <span class="badge badge-sold">🔴 Sold Out</span>
                        @else
                            <span class="badge badge-available">🟢 Tersedia</span>
                        @endif
                    </div>

                    <div class="admin-actions">
                        <a class="admin-mini-btn" title="Edit produk" href="{{ route('admin.products.edit', $product) }}">✏ Edit</a>

                        <form method="POST"
                              action="{{ route('admin.products.destroy', $product) }}"
                              data-confirm-submit
                              data-confirm-title="Hapus Produk?"
                              data-confirm-message="Produk {{ $product->title }} akan dihapus permanen dari katalog.">
                            @csrf
                            @method('DELETE')
                            <button type="submit" title="Hapus produk" class="admin-mini-btn danger">🗑 Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Belum ada produk.</div>
            @endforelse
        </div>

        <div class="admin-pagination">
            {{ $products->links() }}
        </div>
    </div>
@endsection
