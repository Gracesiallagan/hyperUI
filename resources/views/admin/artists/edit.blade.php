@extends('layouts.admin')
@section('title', 'Edit Pengrajin')
@section('page_title', 'Edit Pengrajin')
@section('page_subtitle', 'Perbarui profil pengrajin')

@section('content')
    <div class="admin-page-actions">
        <div>
            <h1 class="admin-h1">Edit Pengrajin</h1>
            <p class="admin-p">Perbarui nama, tipe disabilitas, bio, dan foto pengrajin.</p>
        </div>
        <a href="{{ route('admin.artists.index') }}" class="btn btn-ghost">&larr; Kembali</a>
    </div>

    <div class="admin-form-wrap">
        <form method="POST" action="{{ route('admin.artists.update', $artist) }}" enctype="multipart/form-data" class="admin-form-card" data-confirm-submit data-confirm-title="Simpan Perubahan Pengrajin?" data-confirm-message="Profil pengrajin akan diperbarui.">
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
                    <label class="label" for="name">Nama Pengrajin</label>
                    <input id="name" type="text" name="name" value="{{ old('name', $artist->name) }}" required class="input">
                    @error('name') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="disability_type">Tipe Disabilitas</label>
                    <select id="disability_type" name="disability_type" required class="input">
                        @foreach($types as $type)
                            <option value="{{ $type }}" {{ old('disability_type', $artist->disability_type) === $type ? 'selected' : '' }}>{{ $type }}</option>
                        @endforeach
                    </select>
                    @error('disability_type') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label" for="skill">Keahlian</label>
                    <input id="skill" type="text" name="skill" value="{{ old('skill', $artist->skill) }}" class="input" placeholder="Contoh: Lukisan, tenun, kriya">
                    @error('skill') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label class="label">Status</label>
                    <label class="check" style="margin-top:12px;">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $artist->is_active ?? true) ? 'checked' : '' }}>
                        <span>Aktif</span>
                    </label>
                </div>

                <div class="field span-2">
                    <label class="label" for="bio">Bio</label>
                    <textarea id="bio" name="bio" rows="4" class="textarea">{{ old('bio', $artist->bio) }}</textarea>
                    @error('bio') <p class="field-error">{{ $message }}</p> @enderror
                </div>

                <div class="field span-2">
                    <label class="label" for="photo">Foto Pengrajin</label>
                    @if($artist->photo_url)
                        <div style="margin-bottom:12px;">
                            <img src="{{ $artist->photo_url }}" alt="{{ $artist->name }}" style="width:120px;height:120px;object-fit:cover;border-radius:16px;border:1px solid #fed7aa;">
                        </div>
                    @endif
                    <div class="filebox">
                        <input id="photo" type="file" name="photo" accept="image/*" class="fileinput">
                        <div class="filehint">Format: JPG/PNG • Maks: 2MB</div>
                    </div>
                    @error('photo') <p class="field-error">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="admin-form-actions">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('admin.artists.index') }}" class="btn btn-ghost">Batal</a>
            </div>
        </form>
    </div>
@endsection
