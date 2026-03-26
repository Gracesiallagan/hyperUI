@extends('layouts.app')

@section('title', 'Home - GandengTangan')

@section('content')
<div class="container page">
    {{-- HERO --}}
    <section class="hero">
        <div class="hero-grid">
            <div class="hero-left">
                <h1 class="hero-title">
                    Temukan Karya,<br>
                    Dukung <span class="accent">Seniman Disabilitas</span>
                </h1>

                <p class="hero-subtitle">
                    Gandeng Tangan adalah marketplace inklusif untuk karya seni anak-anak disabilitas Indonesia.
                    Setiap pembelian adalah dukungan nyata bagi kreativitas dan kemandirian mereka.
                </p>

                <div class="hero-quick">
                    <a href="{{ route('gallery') }}" class="btn btn-primary">Lihat Galeri →</a>
                    <a href="{{ route('about') }}" class="btn btn-ghost">Tentang Kami</a>
                </div>
            </div>

            <div class="hero-right">
                {{-- Carousel karya (pakai $featured) --}}
                <div class="hero-carousel" id="heroCarousel" aria-label="Carousel karya pilihan">
                    <div class="hero-carousel-track" id="heroCarouselTrack">
                        @forelse($featured as $p)
                            <a class="hero-slide" href="{{ route('product.show', $p) }}">
                                @if($p->image)
                                    <img
                                        src="{{ str_starts_with($p->image, 'http') ? $p->image : asset('storage/'.$p->image) }}"
                                        alt="{{ $p->title }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="hero-slide-fallback">🖼️</div>
                                @endif

                                <div class="hero-slide-overlay">
                                    <div class="hero-slide-title">{{ $p->title }}</div>
                                    <div class="hero-slide-sub">
                                        {{ $p->artist->name ?? '-' }}
                                        @if($p->artist?->organization)
                                            • {{ $p->artist->organization->name }}
                                        @endif
                                    </div>
                                    <div class="hero-slide-price">
                                        Rp {{ number_format((int)$p->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="hero-slide">
                                <div class="hero-slide-fallback">🖼️</div>
                                <div class="hero-slide-overlay">
                                    <div class="hero-slide-title">Belum ada karya pilihan</div>
                                    <div class="hero-slide-sub">Jalankan seeder / tambahkan produk</div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="hero-dots" id="heroDots" aria-label="Carousel indicators"></div>

                    <button class="hero-nav hero-prev" type="button" aria-label="Sebelumnya" id="heroPrev">‹</button>
                    <button class="hero-nav hero-next" type="button" aria-label="Berikutnya" id="heroNext">›</button>
                </div>

                <div class="mini-card">
                    <div class="mini-row">
                        <div class="mini-thumb">🧡</div>
                        <div class="mini-meta">
                            <div class="mini-title">Dukungan Langsung</div>
                            <div class="mini-sub">Setiap karya membantu seniman</div>
                        </div>
                        <div class="mini-price">Impact</div>
                    </div>
                    <div class="mini-actions">
                        <a href="{{ route('about') }}" class="mini-link">Lihat Dampak →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- CATEGORIES + PRODUCTS --}}
<section class="section">
    <div class="section-head">
        <div>
            <h2 class="section-title">Kategori Populer</h2>
            <p class="section-subtitle">Jelajahi karya berdasarkan kategori.</p>
        </div>
        <a href="{{ route('gallery') }}" class="section-link">Lihat semua di Galeri →</a>
    </div>

    <div class="home-cats">
        @forelse($categories as $cat)
            <a class="home-cat" href="{{ route('gallery', ['category' => $cat->slug ?? $cat->name]) }}">
                <div class="home-cat-icon">{{ $cat->icon ?? '🗂️' }}</div>
                <div class="home-cat-name">{{ $cat->name }}</div>
                <div class="home-cat-sub">{{ $cat->description ? \Illuminate\Support\Str::limit($cat->description, 48) : 'Lihat karya di kategori ini' }}</div>
            </a>
        @empty
            <div class="empty-state">Kategori belum tersedia.</div>
        @endforelse
    </div>
</section>

{{-- PER CATEGORY PRODUCTS --}}
@foreach($productsByCategory as $cat)
    @php $items = $cat->getRelation('home_products'); @endphp
    @if($items && $items->count())
        <section class="section">
            <div class="section-head">
                <div>
                    <h2 class="section-title">{{ $cat->name }}</h2>
                    <p class="section-subtitle">Karya terbaru dari kategori {{ $cat->name }}.</p>
                </div>
                <a href="{{ route('gallery', ['category' => $cat->slug ?? $cat->name]) }}" class="section-link">
                    Lihat semua → 
                </a>
            </div>

            <div class="home-products">
                @foreach($items as $p)
                    <a class="card home-product" href="{{ route('product.show', $p) }}">
                        <div class="home-product-media">
                            @if($p->image)
                                <img src="{{ str_starts_with($p->image, 'http') ? $p->image : asset('storage/'.$p->image) }}" alt="{{ $p->title }}" loading="lazy">
                            @else
                                <div class="home-product-fallback">🖼️</div>
                            @endif
                        </div>

                        <div class="home-product-body">
                            <div class="home-product-title">{{ $p->title }}</div>
                            <div class="home-product-meta">
                                <span class="pill">{{ $p->artist->name ?? '-' }}</span>
                                <span class="muted">{{ $p->artist?->organization?->name ?? '' }}</span>
                            </div>
                            <div class="home-product-price">
                                Rp {{ number_format((int)$p->price, 0, ',', '.') }}
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif
@endforeach

    {{-- STATS, CATEGORIES, NEWSLETTER ... (biarkan seperti sebelumnya) --}}
</div>

{{-- Carousel script (tanpa library) --}}
<script>
(function () {
    const track = document.getElementById('heroCarouselTrack');
    const carousel = document.getElementById('heroCarousel');
    const dotsWrap = document.getElementById('heroDots');
    const btnPrev = document.getElementById('heroPrev');
    const btnNext = document.getElementById('heroNext');

    if (!track || !carousel) return;

    const slides = Array.from(track.children);
    const count = slides.length;
    if (count <= 1) return;

    let index = 0;
    let timer = null;

    // build dots
    slides.forEach((_, i) => {
        const dot = document.createElement('button');
        dot.type = 'button';
        dot.className = 'hero-dot' + (i === 0 ? ' active' : '');
        dot.setAttribute('aria-label', 'Slide ' + (i + 1));
        dot.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(dot);
    });

    const dots = Array.from(dotsWrap.querySelectorAll('.hero-dot'));

    function update() {
        track.style.transform = `translateX(-${index * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === index));
    }

    function goTo(i) {
        index = (i + count) % count;
        update();
        restart();
    }

    function next() { goTo(index + 1); }
    function prev() { goTo(index - 1); }

    btnNext && btnNext.addEventListener('click', next);
    btnPrev && btnPrev.addEventListener('click', prev);

    function start() {
        timer = setInterval(next, 4500);
    }

    function stop() {
        if (timer) clearInterval(timer);
        timer = null;
    }

    function restart() {
        stop();
        start();
    }

    carousel.addEventListener('mouseenter', stop);
    carousel.addEventListener('mouseleave', start);
    carousel.addEventListener('focusin', stop);
    carousel.addEventListener('focusout', start);

    update();
    start();
})();
</script>
@endsection