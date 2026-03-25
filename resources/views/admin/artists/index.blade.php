@extends('layouts.admin')
@section('title', 'Kelola Seniman')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Kelola Seniman</h1>
    <a href="{{ route('admin.artists.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm hover:bg-teal-700">+ Tambah Seniman</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr>
                <th class="px-6 py-3">Nama</th>
                <th class="px-6 py-3">Tipe Disabilitas</th>
                <th class="px-6 py-3">Organisasi</th>
                <th class="px-6 py-3">Jumlah Karya</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($artists as $artist)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3 font-medium">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-teal-100 text-teal-700 rounded-full flex items-center justify-center text-xs font-bold">{{ $artist->avatar }}</div>
                            {{ $artist->name }}
                        </div>
                    </td>
                    <td class="px-6 py-3 text-gray-500">{{ $artist->disability_type }}</td>
                    <td class="px-6 py-3 text-gray-500">{{ $artist->organization->name }}</td>
                    <td class="px-6 py-3">{{ $artist->products_count }}</td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.artists.edit', $artist) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.artists.destroy', $artist) }}" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-gray-400">Belum ada seniman.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $artists->links() }}</div>
</div>
@endsection
