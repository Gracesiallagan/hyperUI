<div class="admin-page-actions">
    <div>
        <h1 class="admin-h1">{{ $button }}</h1>
        <p class="admin-p">Isi nama, icon, dan urutan agar katalog mudah dijelajahi.</p>
    </div>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">&larr; Kembali</a>
</div>

<div class="admin-form-wrap">
    <form method="POST" action="{{ $action }}" class="admin-form-card" data-confirm-submit data-confirm-title="Simpan Kategori?" data-confirm-message="Data kategori akan disimpan dan bisa dipakai pada produk.">
        @csrf
        @if($method !== 'POST') @method($method) @endif

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
                <label class="label" for="name">Nama Kategori</label>
                <input id="name" name="name" class="input" required value="{{ old('name', $category->name) }}" placeholder="Contoh: Kriya Tangan">
                @error('name') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label class="label" for="icon">Icon / Emoji</label>
                <input id="icon" name="icon" class="input" value="{{ old('icon', $category->icon) }}" placeholder="Contoh: 🧵">
                @error('icon') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label class="label" for="sort_order">Urutan</label>
                <input id="sort_order" name="sort_order" type="number" min="0" class="input" value="{{ old('sort_order', $category->sort_order ?? 0) }}">
                @error('sort_order') <p class="field-error">{{ $message }}</p> @enderror
            </div>

            <div class="field">
                <label class="label">Status</label>
                <label class="check" style="margin-top:12px;">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->exists ? $category->is_active : true) ? 'checked' : '' }}>
                    <span>Aktif ditampilkan</span>
                </label>
            </div>

            <div class="field span-2">
                <label class="label" for="description">Deskripsi</label>
                <textarea id="description" name="description" class="textarea" rows="4" placeholder="Deskripsi singkat kategori...">{{ old('description', $category->description) }}</textarea>
                @error('description') <p class="field-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="admin-form-actions">
            <button class="btn btn-primary" type="submit">{{ $button }}</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-ghost">Batal</a>
        </div>
    </form>
</div>
