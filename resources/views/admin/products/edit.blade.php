@extends('layouts.admin')
@section('title', 'Edit Produk')

@section('content')
<h1 class="text-2xl font-bold mb-6">Edit Produk</h1>

<form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-8 max-w-2xl">
    @csrf @method('PUT')

    <div class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Judul Karya</label>
            <input type="text" name="title" value="{{ old('title', $product->title) }}" required
                   class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-teal-500 focus:border-teal-500">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="category" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ $product->category === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Media/Teknik</label>
                <input type="text" name="medium" value="{{ old('medium', $product->medium) }}"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)</label>
                <input type="number" name="price" value="{{ old('price', $product->price) }}" required min="0"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Seniman</label>
                <select name="artist_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                    @foreach($artists as $artist)
                        <option value="{{ $artist->id }}" {{ $product->artist_id === $artist->id ? 'selected' : '' }}>
                            {{ $artist->name }} {{ $artist->organization ? '(' . $artist->organization->name . ')' : '' }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="flex gap-6">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_sold" value="1" {{ $product->is_sold ? 'checked' : '' }} class="rounded text-teal-600">
                <span class="text-sm">Terjual</span>
            </label>
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" value="1" {{ $product->is_featured ? 'checked' : '' }} class="rounded text-teal-600">
                <span class="text-sm">Tampilkan di Beranda</span>
            </label>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar</label>
            @if($product->image)
                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                     class="w-24 h-24 rounded-lg object-cover mb-2" alt="">
            @endif
            <input type="file" name="image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-teal-50 file:text-teal-700">
        </div>

        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 font-medium">Perbarui</button>
            <a href="{{ route('admin.products.index') }}" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">Batal</a>
        </div>
    </div>
</form>
@endsection
