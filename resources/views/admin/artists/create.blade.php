@extends('layouts.admin')
@section('title', 'Tambah Seniman')

@section('content')
<h1 class="text-2xl font-bold mb-6">Tambah Seniman</h1>

<form method="POST" action="{{ route('admin.artists.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl shadow-sm p-8 max-w-2xl">
    @csrf
    <div class="space-y-5">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Tipe Disabilitas</label>
            <select name="disability_type" required class="w-full border border-gray-300 rounded-lg px-4 py-2">
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ $type }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
            <textarea name="bio" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2">{{ old('bio') }}</textarea>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
            <input type="file" name="photo" accept="image/*" class="w-full text-sm">
        </div>
        <div class="flex gap-3 pt-4">
            <button type="submit" class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">Simpan</button>
            <a href="{{ route('admin.artists.index') }}" class="px-6 py-2 bg-gray-100 text-gray-600 rounded-lg">Batal</a>
        </div>
    </div>
</form>
@endsection
