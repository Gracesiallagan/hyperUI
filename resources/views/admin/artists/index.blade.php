@extends('layouts.admin')
@section('title', 'Kelola Seniman')
@section('page_title', 'Kelola Seniman')
@section('page_subtitle', 'Kelola data seniman dan jumlah karya')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Kelola Seniman</h1>
            <p class="admin-p">
                Daftar seniman berdasarkan akses organisasi Anda.
            </p>
        </div>

        <a href="{{ route('admin.artists.create') }}" class="btn btn-primary">
            + Tambah Seniman
        </a>
    </div>

    <div class="admin-panel">
        <div class="admin-panel-head">
            <h2 class="admin-h2">Daftar Seniman</h2>
            <div class="admin-muted">Total: {{ $artists->total() }}</div>
        </div>

        <div class="admin-table admin-table-scroll">
            <div class="admin-table-head admin-table-head-5">
                <div>Seniman</div>
                <div>Tipe Disabilitas</div>
                <div>Organisasi</div>
                <div>Jumlah Karya</div>
                <div style="text-align:right;">Aksi</div>
            </div>

            @forelse($artists as $artist)
                <div class="admin-table-row admin-table-row-artist">
                    <div class="admin-artist">
                        <div class="admin-artist-avatar">
                            {{ $artist->avatar ?: strtoupper(substr($artist->name, 0, 1)) }}
                        </div>
                        <div class="admin-artist-meta">
                            <div class="admin-artist-name">{{ $artist->name }}</div>
                            <div class="admin-artist-sub">
                                ID: {{ $artist->id }}
                                @if($artist->created_at)
                                    • {{ $artist->created_at->format('d M Y') }}
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="admin-muted">{{ $artist->disability_type }}</div>

                    <div class="admin-muted">{{ $artist->organization->name ?? '-' }}</div>

                    <div class="admin-count">
                        {{ $artist->products_count ?? 0 }}
                    </div>

                    <div class="admin-actions">
                        <a class="admin-mini-btn" href="{{ route('admin.artists.edit', $artist) }}">Edit</a>

                        <form method="POST"
                              action="{{ route('admin.artists.destroy', $artist) }}"
                              onsubmit="return confirm('Yakin hapus seniman ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-mini-btn danger">Hapus</button>
                        </form>
                    </div>
                </div>
            @empty
                <div class="admin-empty">Belum ada seniman.</div>
            @endforelse
        </div>

        <div class="admin-pagination">
            {{ $artists->links() }}
        </div>
    </div>
@endsection