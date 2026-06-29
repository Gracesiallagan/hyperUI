@extends('layouts.app')

@section('title', 'Home - GandengTangan')

@section('content')
<div class="container page">
    <section class="hero">
        <div class="hero-grid">
            <div class="hero-left">
                <h1 class="hero-title">
                    Temukan Produk,<br>
                    Dukung <span class="accent">Pengrajin Disabilitas</span>
                </h1>

                <p class="hero-subtitle">
                    GandengTangan adalah katalog inklusif untuk membantu publik menemukan produk buatan pengrajin disabilitas.
                    Setiap minat beli akan diarahkan ke admin melalui WhatsApp.
                </p>

                <div class="hero-quick">
                    <a href="{{ route('catalog') }}" class="btn btn-primary">Lihat Katalog</a>
                    <a href="{{ route('about') }}" class="btn btn-ghost">Tentang Kami</a>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-carousel" id="heroCarousel" aria-label="Carousel produk pilihan">
                    <div class="hero-carousel-track" id="heroCarouselTrack">
                        @forelse($featured as $p)
                            <a class="hero-slide" href="{{ route('product.show', $p) }}">
                                @if($p->image_url)
                                    <img
                                        src="{{ $p->image_url }}"
                                        alt="{{ $p->title }}"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="hero-slide-fallback">IMG</div>
                                @endif

                                <div class="hero-slide-overlay">
                                    <div class="hero-slide-title">{{ $p->title }}</div>
                                    <div class="hero-slide-sub">{{ $p->artist->name ?? '-' }}</div>
                                    <div class="hero-slide-price">
                                        Rp {{ number_format((int)$p->price, 0, ',', '.') }}
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="hero-slide">
                                <div class="hero-slide-fallback">IMG</div>
                                <div class="hero-slide-overlay">
                                    <div class="hero-slide-title">Belum ada produk pilihan</div>
                                    <div class="hero-slide-sub">Tambahkan produk dari admin</div>
                                </div>
                            </div>
                        @endforelse
                    </div>

                    <div class="hero-dots" id="heroDots" aria-label="Carousel indicators"></div>

                    <button class="hero-nav hero-prev" type="button" aria-label="Sebelumnya" id="heroPrev">&lsaquo;</button>
                    <button class="hero-nav hero-next" type="button" aria-label="Berikutnya" id="heroNext">&rsaquo;</button>
                </div>

                <div class="mini-card">
                    <div class="mini-row">
                        <div class="mini-thumb">Info</div>
                        <div class="mini-meta">
                            <div class="mini-title">Inquiry via WhatsApp</div>
                            <div class="mini-sub">Alur beli dibuat sederhana untuk MVP</div>
                        </div>
                        <div class="mini-price">MVP</div>
                    </div>
                    <div class="mini-actions">
                        <a href="{{ route('how_to_buy') }}" class="mini-link">Lihat Cara Beli</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats compact-stats" aria-label="Statistik GandengTangan">
        <div class="stat-card"><div class="stat-icon">Produk</div><div><div class="stat-value">{{ $stats['products'] }}</div><div class="stat-label">Produk Katalog</div></div></div>
        <div class="stat-card"><div class="stat-icon">Karya</div><div><div class="stat-value">{{ $stats['artists'] }}</div><div class="stat-label">Pengrajin</div></div></div>
        <div class="stat-card"><div class="stat-icon">Sold</div><div><div class="stat-value">{{ $stats['sold'] }}</div><div class="stat-label">Produk Sold Out</div></div></div>
    </section>

    <section class="section">
        <div class="section-head">
            <div>
                <h2 class="section-title">Kategori Populer</h2>
                <p class="section-subtitle">Jelajahi produk berdasarkan kategori.</p>
            </div>
            <a href="{{ route('catalog') }}" class="section-link">Lihat semua di Katalog</a>
        </div>

        <div class="home-cats">
            @forelse($categories as $cat)
                <a class="home-cat" href="{{ route('catalog', ['category' => $cat->slug ?? $cat->name]) }}">
                    <div class="home-cat-icon">{{ $cat->icon ?? 'CAT' }}</div>
                    <div class="home-cat-name">{{ $cat->name }}</div>
                    <div class="home-cat-sub">{{ $cat->description ? \Illuminate\Support\Str::limit($cat->description, 48) : 'Lihat produk di kategori ini' }}</div>
                </a>
            @empty
                <div class="empty-state">Kategori belum tersedia.</div>
            @endforelse
        </div>
    </section>

    @foreach($productsByCategory as $cat)
        @php $items = $cat->getRelation('home_products'); @endphp
        @if($items && $items->count())
            <section class="section">
                <div class="section-head">
                    <div>
                        <h2 class="section-title">{{ $cat->name }}</h2>
                        <p class="section-subtitle">Produk terbaru dari kategori {{ $cat->name }}.</p>
                    </div>
                    <a href="{{ route('catalog', ['category' => $cat->slug ?? $cat->name]) }}" class="section-link">
                        Lihat semua
                    </a>
                </div>

                <div class="home-products">
                    @foreach($items as $p)
                        <a class="card home-product" href="{{ route('product.show', $p) }}">
                            <div class="home-product-media">
                                @if($p->image_url)
                                    <img src="{{ $p->image_url }}" alt="{{ $p->title }}" loading="lazy">
                                @else
                                    <div class="home-product-fallback">IMG</div>
                                @endif
                            </div>

                            <div class="home-product-body">
                                <div class="home-product-title">{{ $p->title }}</div>
                                <div class="home-product-meta">
                                    <span class="pill">{{ $p->artist->name ?? '-' }}</span>
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

    <section class="section why-section">
        <div class="section-head">
            <div>
                <h2 class="section-title">Mengapa Memilih GandengTangan?</h2>
                <p class="section-subtitle">Katalog inklusif yang sederhana untuk pembeli dan bermanfaat bagi pengrajin.</p>
            </div>
        </div>
        <div class="why-grid">
            <div class="card why-card"><div class="why-icon">🧡</div><h3>Dukung Dampak Sosial</h3><p>Setiap pembelian membantu membuka peluang ekonomi bagi pengrajin disabilitas.</p></div>
            <div class="card why-card"><div class="why-icon">📦</div><h3>Produk Terpilih</h3><p>Produk ditampilkan dengan informasi harga, stok, kategori, dan pengrajin yang jelas.</p></div>
            <div class="card why-card"><div class="why-icon">💬</div><h3>Order Mudah</h3><p>Cukup klik WhatsApp, pesan otomatis berisi detail produk untuk admin.</p></div>
        </div>
        <div class="cta-strip">
            <div><strong>Siap melihat karya pengrajin?</strong><span>Temukan produk unik dan dukung karya inklusif hari ini.</span></div>
            <a class="btn btn-primary" href="{{ route('catalog') }}">Lihat Katalog</a>
        </div>
    </section>
</div>

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
