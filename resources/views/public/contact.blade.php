@extends('layouts.app')

@section('title', 'Kontak - GandengTangan')

@section('content')
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Kontak</h1>
            <p class="page-subtitle">Hubungi admin GandengTangan untuk pertanyaan produk, kolaborasi, atau informasi pembelian.</p>
        </div>
    </div>

    <div class="card" style="padding: 24px;">
        <p style="margin: 0 0 12px;">Untuk tahap MVP, seluruh proses tanya produk dan pembelian akan diarahkan ke admin.</p>
        <p style="margin: 0 0 12px;">Silakan gunakan tombol WhatsApp pada detail produk untuk menghubungi admin secara langsung.</p>
        <p style="margin: 0;"><a class="btn btn-primary" href="{{ route('catalog') }}">Lihat Katalog</a></p>
    </div>
</div>
@endsection
