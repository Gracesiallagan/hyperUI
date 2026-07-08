@extends('layouts.app')

@section('title', 'Our Artists - GandengTangan')

@section('content')
<div class="container page">
    <div class="artists-head">
        <div>
            <h1 class="page-title">Our Artists</h1>
            <p class="page-subtitle">Kenali para pengrajin dan karya-karya terbaiknya.</p>
        </div>
    </div>

    <form class="artists-filters" method="GET" action="{{ route('artists') }}">
        <div class="filter">
            <label class="filter-label" for="search">Search</label>
            <input id="search" class="filter-input" type="text" name="search" value="{{ request('search') }}"
                   placeholder="Cari nama pengrajin / bio...">
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
            <a class="btn btn-ghost" href="{{ route('artists') }}">Reset</a>
        </div>
    </form>

    <div class="artists-grid artists-grid-cards">
        @forelse($artists as $a)
            <a class="artist-card2" href="{{ route('artists.show', $a) }}">
                <div class="artist-cover">
                    @if($a->photo)
                        <img src="{{ asset('storage/'.$a->photo) }}" alt="{{ $a->name }}">
                    @else
                        <div class="artist-cover-fallback">
                            <div class="artist-cover-avatar">
                                {{ $a->avatar ?: strtoupper(substr($a->name, 0, 1)) }}
                            </div>
                        </div>
                    @endif

                    <div class="artist-cover-badges">
                        <span class="badge2">{{ $a->disability_type }}</span>
                        @if($a->organization)
                            <span class="badge2 ghost">{{ $a->organization->name }}</span>
                        @endif
                    </div>
                </div>

                <div class="artist-card-body">
                    <div class="artist-card-title">{{ $a->name }}</div>

                    @if($a->bio)
                        <div class="artist-card-bio">
                            {{ \Illuminate\Support\Str::limit($a->bio, 90) }}
                        </div>
                    @else
                        <div class="artist-card-bio muted">
                            Profil belum memiliki bio.
                        </div>
                    @endif

                    <div class="artist-card-foot">
                        <div class="artist-mini-stats">
                            <div class="mini-stat">
                                <div class="mini-stat-value">{{ $a->products_count ?? 0 }}</div>
                                <div class="mini-stat-label">Karya</div>
                            </div>
                        </div>

                        <div class="artist-cta">
                            <span class="btn btn-dark btn-small">Lihat Detail →</span>
                        </div>
                    </div>
                </div>
            </a>
        @empty
            <div class="empty-state">Belum ada pengrajin.</div>
        @endforelse
    </div>

    <div class="pagination-wrap">
    {{ $artists->withQueryString()->links('vendor.pagination.simple-gt') }}
</div>
</div>
@endsection