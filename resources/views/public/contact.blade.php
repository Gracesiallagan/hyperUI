@extends('layouts.app')

@section('title', 'Kontak - GandengTangan')

@section('content')
@php
    $setting = \Illuminate\Support\Facades\Schema::hasTable('settings') ? \App\Models\Setting::query()->first() : null;
    $wa = preg_replace('/\D+/', '', $setting->whatsapp_number ?? config('whatsapp.admin_number', '6281361428113'));
    if (str_starts_with($wa, '0')) $wa = '62'.substr($wa, 1);
    $message = urlencode('Halo admin GandengTangan, saya ingin bertanya tentang katalog produk.');
@endphp
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Hubungi GandengTangan</h1>
            <p class="page-subtitle">Kami siap membantu pertanyaan produk, kolaborasi, dan pemesanan karya pengrajin disabilitas.</p>
        </div>
    </div>

    <div class="contact-grid contact-grid-4">
        <div class="card contact-card"><div class="contact-icon">📍</div><h2>Alamat</h2><p>{{ optional($setting)->address ?: 'Indonesia' }}</p></div>
        <div class="card contact-card"><div class="contact-icon">WA</div><h2>WhatsApp</h2><p>{{ optional($setting)->whatsapp_number ?? '6281361428113' }}</p><a class="btn btn-primary" href="https://wa.me/{{ $wa }}?text={{ $message }}" target="_blank" rel="noreferrer">Chat Admin</a></div>
        <div class="card contact-card"><div class="contact-icon">✉️</div><h2>Email</h2><p>{{ optional($setting)->contact_email ?: 'halo@gandengtangan.id' }}</p></div>
        <div class="card contact-card"><div class="contact-icon">⏱️</div><h2>Jam Operasional</h2><p>Senin - Sabtu<br>09.00 - 17.00 WIB</p></div>
    </div>

    <div class="card map-placeholder">
        <div>
            <strong>Google Maps</strong>
            <span>Lokasi operasional akan disesuaikan dengan pengelola GandengTangan.</span>
        </div>
        <div class="map-pin">📍</div>
    </div>
</div>
@endsection
