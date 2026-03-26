@extends('layouts.admin')
@section('title', 'Kelola Produk')
@section('page_title', 'Kelola Produk')
@section('page_subtitle', 'Tambah, edit, dan kelola status produk')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Kelola Produk</h1>
            <p class="admin-p">Daftar produk berdasarkan akses organisasi Anda.</p>
        </div>

        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            + Tambah Produk
        </a>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-head">
            <h2 class="admin-h2">Daftar Produk</h2>
            <div class="admin-muted">
                Total: {{ $products->total() }}
            </div>
        </div>

        <div class="admin-table admin-table-scroll">
            <div class="admin-table-head">
                <div>Produk</div>
                <div>Kategori</div>
                <div>Harga</div>
                <div>Seniman</div>
                <div>Status</div>
                <div>Aksi</div>
            </div>

            @forelse($products as $product)
                <div class="admin-table-row admin-table-row-6">
                    <div class="admin-prod">
                        <div class="admin-prod-thumb">
                            @if($product->image)
                                <img
                                    src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
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
                            <span class="badge badge-featured">Featured</span>
                        @endif

                        @if($product->is_sold)
                            <span class="badge badge-sold">Terjual</span>
                        @else
                            <span class="badge badge-available">Tersedia</span>
                        @endif
                    </div>

                    <div class="admin-actions">
                        <a class="admin-mini-btn" href="{{ route('admin.products.edit', $product) }}">Edit</a>

                        <form method="POST"
                              action="{{ route('admin.products.destroy', $product) }}"
                              onsubmit="return confirm('Yakin hapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-mini-btn danger">Hapus</button>
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