@extends('layouts.app')
@section('title', 'Tentang Kami — Gandeng Tangan')

@section('content')
<section class="about-hero">
    <div class="container about-hero-inner">
        <h1 class="about-title">
            Tentang <span class="about-highlight">Gandeng Tangan</span>
        </h1>
        <p class="about-lead">
            Kami percaya bahwa setiap individu memiliki potensi kreatif yang luar biasa.
            Gandeng Tangan hadir untuk menjembatani karya seni anak-anak disabilitas Indonesia
            dengan apresiasi yang layak.
        </p>
    </div>
</section>

<section class="container page">
    <div class="about-features">
        <div class="about-feature card">
            <div class="about-feature-icon">🎨</div>
            <div class="about-feature-title">Kreativitas Inklusif</div>
            <div class="about-feature-text">
                Membuka ruang ekspresi seni tanpa memandang keterbatasan fisik maupun mental.
            </div>
        </div>

        <div class="about-feature card">
            <div class="about-feature-icon">💰</div>
            <div class="about-feature-title">Pemberdayaan Ekonomi</div>
            <div class="about-feature-text">
                Memberikan sumber penghasilan mandiri melalui penjualan karya seni.
            </div>
        </div>

        <div class="about-feature card">
            <div class="about-feature-icon">🤝</div>
            <div class="about-feature-title">Jaringan Kolaborasi</div>
            <div class="about-feature-text">
                Menghubungkan organisasi, sekolah khusus, dan seniman dalam satu ekosistem.
            </div>
        </div>
    </div>

    <div class="about-section-head">
        <h2 class="section-title" style="margin:0;">Organisasi Mitra Kami</h2>
        <p class="section-subtitle" style="margin:6px 0 0;">
            Daftar organisasi yang mendukung dan membina para seniman.
        </p>
    </div>

    <div class="org-grid">
        @foreach($organizations as $org)
            <div class="card org-card">
                <div class="org-head">
                    <div class="org-icon">{{ $org->icon }}</div>
                    <div class="org-meta">
                        <div class="org-name">{{ $org->name }}</div>
                        <div class="org-desc">{{ $org->description }}</div>
                    </div>
                </div>

                <div class="org-stats">
                    <span class="org-stat">🎨 {{ $org->artists_count }} seniman</span>
                    <span class="org-stat">🖼 {{ $org->products_count }} karya</span>
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection