@extends('layouts.admin')
@section('title', 'Kelola Kategori')
@section('page_title', 'Kategori')
@section('page_subtitle', 'Kelola kategori produk untuk katalog')

@section('content')
<div class="admin-page-actions compact-actions">
    <div class="admin-muted">Kategori membantu pembeli menemukan produk dengan lebih cepat.</div>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<div class="admin-panel">
    <div class="admin-panel-head">
        <h2 class="admin-h2">Daftar Kategori</h2>
        <div class="admin-muted">Total: {{ $categories->total() }}</div>
    </div>

    <div class="admin-table admin-table-scroll">
        <div class="admin-table-head admin-table-head-cat">
            <div>Kategori</div>
            <div>Slug</div>
            <div>Jumlah Produk</div>
            <div>Status</div>
            <div style="text-align:right">Aksi</div>
        </div>

        @forelse($categories as $category)
            <div class="admin-table-row-cat">
                <div class="admin-prod">
                    <div class="admin-list-avatar">{{ $category->icon ?: '🏷️' }}</div>
                    <div class="admin-prod-meta">
                        <div class="admin-prod-title">{{ $category->name }}</div>
                        <div class="admin-prod-sub">{{ $category->description ?: 'Tanpa deskripsi' }}</div>
                    </div>
                </div>
                <div class="admin-muted">{{ $category->slug }}</div>
                <div class="admin-count">{{ $category->products_count }}</div>
                <div>
                    <span class="badge {{ $category->is_active ? 'badge-available' : 'badge-sold' }}">
                        {{ $category->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <div class="admin-actions">
                    <a class="admin-mini-btn" title="Edit kategori" href="{{ route('admin.categories.edit', $category) }}">✏ Edit</a>
                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" data-confirm-submit data-confirm-title="Hapus Kategori?" data-confirm-message="Kategori {{ $category->name }} akan dihapus jika tidak dipakai produk.">
                        @csrf
                        @method('DELETE')
                        <button class="admin-mini-btn danger" title="Hapus kategori" type="submit">🗑 Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="admin-empty">Belum ada kategori. Tambahkan kategori agar produk bisa dibuat.</div>
        @endforelse
    </div>

    <div class="admin-pagination">{{ $categories->links() }}</div>
</div>
@endsection
