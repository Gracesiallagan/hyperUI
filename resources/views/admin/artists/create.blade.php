@extends('layouts.admin')
@section('title', 'Tambah Pengrajin')
@section('page_title', 'Tambah Pengrajin')
@section('page_subtitle', 'Tambahkan data pengrajin baru')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Tambah Pengrajin</h1>
            <p class="admin-p">Lengkapi data pengrajin. Foto bersifat opsional.</p>
        </div>

        <a href="{{ route('admin.artists.index') }}" class="btn btn-ghost">
            ← Kembali
        </a>
    </div>

    <div class="admin-form-wrap">
        <form method="POST"
              action="{{ route('admin.artists.store') }}"
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
                    <label class="label" for="name">Nama</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" required class="input" placeholder="Contoh: Risky">
                    @error('name') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="disability_type">Tipe Disabilitas</label>
                    <select id="disability_type" name="disability_type" required class="input">
                        <option value="" disabled {{ old('disability_type') ? '' : 'selected' }}>Pilih tipe</option>
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('disability_type') === $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </select>
                    @error('disability_type') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="skill">Keahlian</label>
                    <input id="skill" type="text" name="skill" value="{{ old('skill') }}" class="input" placeholder="Contoh: Lukisan, tenun, kriya">
                    @error('skill') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label">Status</label>
                    <label class="check" style="margin-top:12px;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                        <span>Aktif</span>
                    </label>
                </div>

                <div class="field span-2">
                    <label class="label" for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="textarea"
                              placeholder="Ceritakan singkat tentang pengrajin...">{{ old('bio') }}</textarea>
                    @error('bio') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="photo">Foto (opsional)</label>

                    <div class="filebox">
                        <input id="photo" type="file" name="photo" accept="image/*" class="fileinput">
                        <div class="filehint">Format: JPG/PNG • Maks: 2MB</div>
                    </div>

                    @error('photo') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.artists.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>

        <div class="admin-help-card">
            <div class="help-title">Catatan</div>
            <ul class="help-list">
                <li>Avatar akan dibuat otomatis dari huruf pertama nama.</li>
                <li>Pengrajin otomatis terhubung ke organisasi user yang sedang login.</li>
                <li>Anda bisa mengubah foto kapan saja melalui menu Edit.</li>
            </ul>
        </div>
    </div>
@endsection