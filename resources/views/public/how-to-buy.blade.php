@extends('layouts.app')

@section('title', 'Cara Beli - GandengTangan')

@section('content')
<div class="container page">
    <div class="gallery-head">
        <div>
            <h1 class="page-title">Cara Beli</h1>
            <p class="page-subtitle">Alur pembelian MVP dibuat sederhana melalui WhatsApp admin.</p>
        </div>
    </div>

    <div class="card" style="padding: 24px;">
        <ol style="margin: 0; padding-left: 18px;">
            <li style="margin-bottom: 8px;">Buka katalog dan pilih produk yang diminati.</li>
            <li style="margin-bottom: 8px;">Masuk ke halaman detail produk untuk melihat informasi lengkap.</li>
            <li style="margin-bottom: 8px;">Klik tombol WhatsApp untuk menghubungi admin.</li>
            <li>Admin akan membantu konfirmasi ketersediaan dan proses pembelian.</li>
        </ol>
    </div>
</div>
@endsection
