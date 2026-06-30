@extends('layouts.admin')
@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk')
@section('page_subtitle', 'Perbarui informasi produk dan nomor WhatsApp admin')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Edit Produk</h1>
            <p class="admin-p">Perbaiki detail produk, status tampil, gambar, dan nomor WhatsApp admin.</p>
        </div>

        <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">
            &larr; Kembali
        </a>
    </div>

    <div class="admin-form-wrap">
        <form method="POST"
              action="{{ route('admin.products.update', $product) }}"
              enctype="multipart/form-data"
              class="admin-form-card"
              data-confirm-submit
              data-confirm-title="Simpan Perubahan Produk?"
              data-confirm-message="Data produk akan diperbarui dan langsung tampil di katalog.">
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
                    <label class="label" for="title">Judul Produk</label>
                    <input id="title" type="text" name="title" value="{{ old('title', $product->title) }}" required class="input">
                    @error('title') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="artist_id">Pengrajin</label>
                    <select id="artist_id" name="artist_id" required class="input">
                        @foreach($artists as $artist)
                            <option value="{{ $artist->id }}" {{ (string) old('artist_id', $product->artist_id) === (string) $artist->id ? 'selected' : '' }}>
                                {{ $artist->name }}{{ $artist->skill ? ' - ' . $artist->skill : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('artist_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="category_id">Kategori</label>
                    <select id="category_id" name="category_id" required class="input">
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ (string) old('category_id', $product->category_id) === (string) $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="medium">Media / Teknik</label>
                    <input id="medium" type="text" name="medium" value="{{ old('medium', $product->medium) }}" class="input">
                    @error('medium') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="price">Harga (Rp)</label>
                    <input id="price" type="number" name="price" value="{{ old('price', $product->price) }}" required min="0" class="input">
                    @error('price') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="stock">Stok</label>
                    <input id="stock" type="number" name="stock" value="{{ old('stock', $product->stock ?? ($product->is_sold ? 0 : 1)) }}" required min="0" class="input">
                    <div class="hint">Isi 0 untuk otomatis Sold Out.</div>
                    @error('stock') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="whatsapp_number">Nomor WhatsApp Admin</label>
                    <input id="whatsapp_number" type="text" name="whatsapp_number" value="{{ old('whatsapp_number', $settings->whatsapp_number ?? '081361428113') }}" class="input" placeholder="Contoh: 081361428113">
                    @error('whatsapp_number') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="description">Deskripsi</label>
                    <textarea id="description" name="description" rows="4" class="textarea">{{ old('description', $product->description) }}</textarea>
                    @error('description') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="image">Gambar Produk</label>

                    @if($product->image_url)
                        <div style="margin-bottom: 12px;">
                            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" style="width: 120px; height: 120px; object-fit: cover; border-radius: 16px; border: 1px solid #d6d3d1;">
                        </div>
                    @endif

                    <div class="filebox">
                        <input id="image" type="file" name="image" accept="image/*" class="fileinput">
                        <div class="filehint">Format: JPG/PNG • Maks: 2MB</div>
                    </div>
                    @error('image') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <div style="display:flex; gap: 18px; flex-wrap: wrap;">
                        <label class="check">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                            <span>Tampilkan sebagai produk unggulan</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.products.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>

        <div class="admin-help-card">
            <div class="help-title">Panduan Singkat</div>
            <ul class="help-list">
                <li>Pastikan nama, harga, stok, dan foto produk sudah benar.</li>
                <li>Gunakan foto yang terang dan menampilkan produk dengan jelas.</li>
            </ul>
        </div>
    </div>
@endsection
