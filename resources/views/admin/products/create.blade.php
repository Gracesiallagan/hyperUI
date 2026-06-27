@extends('layouts.admin')
@section('title', 'Tambah Produk')
@section('page_title', 'Tambah Produk')
@section('page_subtitle', 'Tambahkan karya baru ke marketplace')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Tambah Produk Baru</h1>
            <p class="admin-p">Isi informasi produk dengan lengkap. Gambar bersifat opsional.</p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
            ← Kembali
        </a>
    </div>

    <div class="admin-form-wrap">
        <form method="POST"
              action="{{ route('admin.products.store') }}"
              enctype="multipart/form-data"
              class="admin-form-card">
            @csrf

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
                    <label class="label" for="title">Judul Karya</label>
                    <input id="title" type="text" name="title" value="{{ old('title') }}" required class="input">
                    @error('title') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="artist_id">Seniman</label>
                    <select id="artist_id" name="artist_id" required class="input">
                        <option value="" disabled {{ old('artist_id') ? '' : 'selected' }}>Pilih seniman</option>
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ (string)old('artist_id') === (string)$artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}{{ $artist->organization ? ' (' . $artist->organization->name . ')' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" required class="input">
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Pilih kategori</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (string)old('category_id') === (string)$cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="medium">Media / Teknik</label>
                    <input id="medium" type="text" name="medium" value="{{ old('medium') }}" class="input" placeholder="Contoh: Akrilik di kanvas">
                    @error('medium') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="price">Harga (Rp)</label>
                    <input id="price" type="number" name="price" value="{{ old('price', 0) }}" required min="0" class="input">
                    @error('price') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="whatsapp_number">Nomor WhatsApp Admin</label>
                    <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '') }}" class="input" placeholder="Contoh: 6281234567890">
                    @error('whatsapp_number') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="textarea"
                              placeholder="Ceritakan makna karya, ukuran, dan detail lainnya...">{{ old('description') }}</textarea>
                    @error('description') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="image">Gambar (opsional)</label>

                    <div class="filebox">
                        <input id="image" type="file" name="image" accept="image/*" class="fileinput">
                        <div class="filehint">
                            Format: JPG/PNG • Maks: 2MB
                        </div>
                    </div>

                    @error('image') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>

        <div class="admin-help-card">
            <div class="help-title">Tips</div>
            <ul class="help-list">
                <li>Gunakan judul singkat dan mudah dicari.</li>
                <li>Harga disarankan tanpa titik/koma (contoh: 500000).</li>
                <li>Nomor WhatsApp admin disimpan ke database dan dipakai di halaman publik.</li>
                <li>Jika gambar belum siap, Anda bisa upload nanti lewat Edit.</li>
            </ul>
        </div>
    </div>
@endsection
