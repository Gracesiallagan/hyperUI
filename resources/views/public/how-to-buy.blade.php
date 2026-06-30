@extends('layouts.app')

@section('title', 'Cara Membeli - GandengTangan')

@section('content')
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Cara Membeli</h1>
            <p class="page-subtitle">Ikuti alur sederhana berikut untuk membeli atau menanyakan ketersediaan produk.</p>
        </div>
    </div>

    <div class="timeline-buy">
        <div class="timeline-item"><div class="timeline-dot">1</div><div class="card timeline-card"><span>🛍️</span><h2>Pilih Produk</h2><p>Buka katalog dan pilih produk yang paling Anda sukai.</p></div></div>
        <div class="timeline-item"><div class="timeline-dot">2</div><div class="card timeline-card"><span>🔎</span><h2>Lihat Detail</h2><p>Periksa foto, harga, stok, kategori, deskripsi, dan pengrajin.</p></div></div>
        <div class="timeline-item"><div class="timeline-dot">3</div><div class="card timeline-card"><span>💬</span><h2>Hubungi Admin</h2><p>Klik tombol WhatsApp. Pesan otomatis akan terisi detail produk.</p></div></div>
        <div class="timeline-item"><div class="timeline-dot">4</div><div class="card timeline-card"><span>✅</span><h2>Konfirmasi</h2><p>Admin membantu memastikan ketersediaan, pembayaran, dan alamat kirim.</p></div></div>
        <div class="timeline-item"><div class="timeline-dot">5</div><div class="card timeline-card"><span>📦</span><h2>Pengiriman</h2><p>Produk dikemas dan dikirim sesuai hasil konfirmasi dengan admin.</p></div></div>
    </div>

    <div class="cta-strip">
        <div><strong>Mulai dari katalog</strong><span>Produk Sold Out tetap bisa ditanyakan ketersediaannya.</span></div>
        <a class="btn btn-primary" href="{{ route('catalog') }}">Lihat Katalog</a>
    </div>
</div>
@endsection
