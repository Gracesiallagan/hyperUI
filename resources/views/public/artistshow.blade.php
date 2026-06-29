@extends('layouts.app')

@section('title', $artist->name . ' - Pengrajin')

@section('content')
<div class="container page">
    <div class="artist-show-head">
        <a class="btn btn-ghost" href="{{ route('artists') }}">← Kembali</a>

        <div class="artist-show-card">
            <div class="artist-show-avatar">
                {{ $artist->avatar ?: strtoupper(substr($artist->name, 0, 1)) }}
            </div>

            <div class="artist-show-meta">
                <h1 class="page-title" style="margin:0;">{{ $artist->name }}</h1>
                <p class="page-subtitle" style="margin:6px 0 0;">
                    {{ $artist->disability_type }}
                    @if($artist->organization)
                        • {{ $artist->organization->name }}
                    @endif
                </p>

                @if($artist->bio)
                    <div class="artist-bio">{{ $artist->bio }}</div>
                @endif
            </div>
        </div>
    </div>

    <h2 class="section-title">Karya Terbaru</h2>

    <div class="gallery-grid">
        @forelse($artist->products as $p)
            <a class="card artwork-card" href="{{ route('product.show', $p) }}">
                <div class="artwork-media">
                    @if($p->image_url)
                        <img src="{{ $p->image_url }}" alt="{{ $p->title }}">
                    @else
                        <div class="artwork-placeholder">🖼️</div>
                    @endif
                </div>

                <div class="artwork-body">
                    <div class="artwork-top">
                        <div class="artwork-title">{{ $p->title }}</div>
                        <div class="artwork-price">Rp {{ number_format((int)$p->price, 0, ',', '.') }}</div>
                    </div>

                    <div class="artwork-meta">
                        <span class="pill">{{ $p->category->name ?? '-' }}</span>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">Belum ada karya tersedia.</div>
        @endforelse
    </div>
</div>
@endsection
