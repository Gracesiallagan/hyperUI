@extends('layouts.admin')
@section('title', 'Kelola Produk')

@section('content')
<div class="flex items-center justify-between mb-6">
    <h1 class="text-2xl font-bold">Kelola Produk</h1>
    <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm hover:bg-teal-700">+ Tambah Produk</a>
</div>

<div class="bg-white rounded-xl shadow-sm overflow-x-auto">
    <table class="w-full text-sm">
        <thead class="bg-gray-50 text-left">
            <tr>
                <th class="px-6 py-3">Gambar</th>
                <th class="px-6 py-3">Judul</th>
                <th class="px-6 py-3">Kategori</th>
                <th class="px-6 py-3">Harga</th>
                <th class="px-6 py-3">Seniman</th>
                <th class="px-6 py-3">Status</th>
                <th class="px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y">
            @forelse($products as $product)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">
                        @if($product->image)
                            <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                                 class="w-12 h-12 rounded-lg object-cover" alt="">
                        @else
                            <div class="w-12 h-12 bg-gray-100 rounded-lg"></div>
                        @endif
                    </td>
                    <td class="px-6 py-3 font-medium">{{ $product->title }}</td>
                    <td class="px-6 py-3 text-gray-500">{{ $product->category }}</td>
                    <td class="px-6 py-3">{{ $product->formatted_price }}</td>
                    <td class="px-6 py-3 text-gray-500">{{ $product->artist->name }}</td>
                    <td class="px-6 py-3">
                        @if($product->is_sold)
                            <span class="bg-red-50 text-red-600 px-2 py-0.5 rounded text-xs">Terjual</span>
                        @else
                            <span class="bg-green-50 text-green-600 px-2 py-0.5 rounded text-xs">Tersedia</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.products.edit', $product) }}" class="text-blue-600 hover:underline text-xs">Edit</a>
                            <form method="POST" action="{{ route('admin.products.destroy', $product) }}" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline text-xs">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="px-6 py-8 text-center text-gray-400">Belum ada produk.</td></tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-4">{{ $products->links() }}</div>
</div>
@endsection
