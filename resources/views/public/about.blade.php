@extends('layouts.app')
@section('title', 'Tentang Kami - GandengTangan')

@section('content')
<section class="about-hero about-hero-modern">
    <div class="container about-hero-grid">
        <div>
            <div class="pill light-pill"><span class="dot"></span> Platform Inklusif</div>
            <h1 class="about-title">Membuka ruang pasar untuk <span class="about-highlight">pengrajin disabilitas</span>.</h1>
            <p class="about-lead">GandengTangan membantu karya lokal lebih mudah ditemukan, dipercaya, dan dipesan melalui alur WhatsApp yang sederhana.</p>
        </div>
        <div class="about-illustration">🤝<span>Karya • Dampak • Mandiri</span></div>
    </div>
</section>

<section class="container page about-page">
    <div class="about-split">
        <div class="card about-block"><div class="about-feature-icon">🎯</div><h2>Visi</h2><p>Menjadi jembatan digital yang memperluas akses pasar bagi pengrajin disabilitas di Indonesia.</p></div>
        <div class="card about-block"><div class="about-feature-icon">🚀</div><h2>Misi</h2><p>Menyediakan katalog produk yang rapi, mudah diakses, dan mendorong transaksi langsung melalui admin.</p></div>
    </div>

    <div class="section-head about-section-head">
        <div>
            <h2 class="section-title">Mengapa GandengTangan?</h2>
            <p class="section-subtitle">Kami membuat proses menemukan dan membeli karya jadi lebih sederhana.</p>
        </div>
    </div>

    <div class="about-features">
        <div class="about-feature card"><div class="about-feature-icon">🛍️</div><div class="about-feature-title">Katalog Produk Inklusif</div><div class="about-feature-text">Produk ditampilkan lengkap dengan harga, stok, kategori, foto, dan pengrajin.</div></div>
        <div class="about-feature card"><div class="about-feature-icon">💬</div><div class="about-feature-title">Order via WhatsApp</div><div class="about-feature-text">Pengunjung cukup klik tombol, pesan otomatis langsung berisi detail produk.</div></div>
        <div class="about-feature card"><div class="about-feature-icon">🧡</div><div class="about-feature-title">Dampak Sosial</div><div class="about-feature-text">Setiap transaksi mendukung kemandirian ekonomi dan apresiasi karya.</div></div>
        <div class="about-feature card"><div class="about-feature-icon">📱</div><div class="about-feature-title">Mudah Diakses</div><div class="about-feature-text">Tampilan dirancang responsive agar nyaman digunakan di ponsel maupun desktop.</div></div>
        <div class="about-feature card"><div class="about-feature-icon">✅</div><div class="about-feature-title">Informasi Jelas</div><div class="about-feature-text">Status Tersedia dan Sold Out dibuat jelas untuk menghindari kebingungan.</div></div>
        <div class="about-feature card"><div class="about-feature-icon">🌱</div><div class="about-feature-title">Siap Berkembang</div><div class="about-feature-text">MVP ini bisa dikembangkan menjadi marketplace inklusif yang lebih lengkap.</div></div>
    </div>
</section>
@endsection
