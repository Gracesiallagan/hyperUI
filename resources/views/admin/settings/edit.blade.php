@extends('layouts.admin')
@section('title', 'Pengaturan')
@section('page_title', 'Pengaturan')
@section('page_subtitle', 'Atur informasi website, kontak, dan WhatsApp admin')

@section('content')
<div class="admin-page-actions compact-actions">
    <div class="admin-muted">Lengkapi informasi agar pengunjung mudah menghubungi GandengTangan.</div>
</div>

<div class="admin-form-wrap">
    <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="admin-form-card" data-confirm-submit data-confirm-title="Simpan Pengaturan?" data-confirm-message="Perubahan pengaturan akan diterapkan pada website.">
        @csrf
        @method('PUT')

        @if ($errors->any())
            <div class="alert alert-danger" style="margin-bottom:12px;">
                <div class="alert-title">Periksa kembali input Anda:</div>
                <ul class="alert-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="admin-form-grid">
            <div class="field">
                <label class="label" for="site_name">Nama Website</label>
                <input id="site_name" name="site_name" class="input" required value="{{ old('site_name', $setting->site_name ?: 'GandengTangan') }}">
            </div>

            <div class="field">
                <label class="label" for="whatsapp_number">Nomor WhatsApp Admin</label>
                <input id="whatsapp_number" name="whatsapp_number" class="input" required value="{{ old('whatsapp_number', $setting->whatsapp_number ?: '6281361428113') }}" placeholder="081361428113">
                <div class="hint">Otomatis dinormalisasi ke format 62xxxxxxxxxxx.</div>
            </div>

            <div class="field">
                <label class="label" for="contact_email">Email Kontak</label>
                <input id="contact_email" name="contact_email" type="email" class="input" value="{{ old('contact_email', $setting->contact_email) }}" placeholder="halo@gandengtangan.id">
            </div>

            <div class="field">
                <label class="label" for="address">Lokasi / Alamat</label>
                <input id="address" name="address" class="input" value="{{ old('address', $setting->address) }}" placeholder="Indonesia">
            </div>

            <div class="field span-2">
                <label class="label" for="short_description">Teks Singkat Platform</label>
                <textarea id="short_description" name="short_description" class="textarea" rows="4">{{ old('short_description', $setting->short_description ?: 'GandengTangan membantu pengrajin disabilitas memasarkan produk/karya mereka melalui katalog inklusif dan pemesanan sederhana via WhatsApp.') }}</textarea>
            </div>

            <div class="field">
                <label class="label" for="logo">Logo Website</label>
                @if($setting->logo)
                    <img class="image-preview" src="{{ route('media.show', ['path' => preg_replace('#^(storage/|public/)#', '', ltrim($setting->logo, '/'))]) }}" alt="Logo GandengTangan">
                @endif
                <div class="filebox">
                    <input id="logo" type="file" name="logo" accept="image/*" class="fileinput">
                    <div class="filehint">JPG/PNG/WebP • Maks 2MB</div>
                </div>
            </div>

            <div class="field">
                <label class="label" for="favicon">Favicon</label>
                @if($setting->favicon)
                    <img class="image-preview" src="{{ route('media.show', ['path' => preg_replace('#^(storage/|public/)#', '', ltrim($setting->favicon, '/'))]) }}" alt="Favicon GandengTangan">
                @endif
                <div class="filebox">
                    <input id="favicon" type="file" name="favicon" accept="image/*,.ico" class="fileinput">
                    <div class="filehint">JPG/PNG/WebP/ICO • Maks 1MB</div>
                </div>
            </div>
        </div>

        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">Simpan Pengaturan</button>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-ghost">Kembali</a>
        </div>
    </form>
</div>
@endsection
