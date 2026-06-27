@extends('layouts.app')
@section('title', 'Tentang Kami - GandengTangan')

@section('content')
<section class="about-hero">
    <div class="container about-hero-inner">
        <h1 class="about-title">
            Tentang <span class="about-highlight">GandengTangan</span>
        </h1>
        <p class="about-lead">
            GandengTangan adalah platform MVP untuk membantu promosi dan pemasaran produk fisik
            buatan pengrajin disabilitas secara lebih sederhana, kredibel, dan mudah diakses.
        </p>
    </div>
</section>

<section class="container page">
    <div class="about-features">
        <div class="about-feature card">
            <div class="about-feature-icon">Produk</div>
            <div class="about-feature-title">Promosi Produk Inklusif</div>
            <div class="about-feature-text">
                Memperkenalkan produk buatan pengrajin disabilitas kepada masyarakat luas.
            </div>
        </div>

        <div class="about-feature card">
            <div class="about-feature-icon">Dampak</div>
            <div class="about-feature-title">Pemberdayaan Ekonomi</div>
            <div class="about-feature-text">
                Mendukung peluang ekonomi melalui katalog produk dan inquiry yang mudah.
            </div>
        </div>

        <div class="about-feature card">
            <div class="about-feature-icon">Alur</div>
            <div class="about-feature-title">Alur Sederhana</div>
            <div class="about-feature-text">
                Pengunjung melihat katalog, membuka detail produk, lalu menghubungi admin via WhatsApp.
            </div>
        </div>
    </div>
</section>
@endsection
