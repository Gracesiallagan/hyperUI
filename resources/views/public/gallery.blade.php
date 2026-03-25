@extends('layouts.app')
@section('title', 'Galeri — Gandeng Tangan')

@section('content')
{{-- Hero --}}
<section class="py-16 text-white" style="background: linear-gradient(135deg, #1a1a2e, #16213e)">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-3">Galeri Karya Digital <span class="text-teal-400">Tanpa Batas</span></h1>
        <p class="text-gray-400 max-w-lg">Temukan keunikan perspektif dalam setiap goresan tangan teman-teman disabilitas.</p>
    </div>
</section>

<section class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Filters --}}
        <form method="GET" action="{{ route('gallery') }}" class="mb-8 space-y-4">
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider mr-2">Kategori:</span>
                <a href="{{ route('gallery', array_merge(request()->except('page', 'category'), [])) }}"
                   class="px-4 py-1.5 rounded-full text-sm font-medium transition
                          {{ !request('category') ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                    Semua
                </a>
                @foreach($categories as $cat)
                    <a href="{{ route('gallery', array_merge(request()->except('page'), ['category' => $cat->slug])) }}"
                       class="px-4 py-1.5 rounded-full text-sm font-medium transition
                              {{ request('category') === $cat->slug ? 'bg-gray-900 text-white' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                        {{ $cat->icon }} {{ $cat->name }}
                    </a>
                @endforeach
            </div>
            <div class="flex flex-wrap items-center gap-2">
                <span class="text-xs font-semibold text-gray-400 uppercase tracking-wider mr-2">Karya Teman:</span>
                @foreach($types as $type)
                    <a href="{{ route('gallery', array_merge(request()->except('page'), ['type' => request('type') === $type ? null : $type])) }}"
                       class="px-3 py-1 rounded-full text-xs font-medium border transition
                              {{ request('type') === $type ? 'border-teal-500 text-teal-600 bg-teal-50' : 'border-gray-200 text-gray-400 hover:border-teal-300' }}">
                        {{ $type }}
                    </a>
                @endforeach
            </div>
            {{-- Search --}}
            <div class="flex gap-2 max-w-md">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari karya atau seniman..."
                       class="flex-1 border border-gray-200 rounded-lg px-4 py-2 text-sm focus:ring-teal-500 focus:border-teal-500">
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg text-sm hover:bg-teal-700">Cari</button>
            </div>
        </form>

        {{-- Grid --}}
        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
                    @include('components.product-card', ['product' => $product])
                @endforeach
            </div>
            <div class="mt-8">{{ $products->withQueryString()->links() }}</div>
        @else
            <div class="text-center py-20 text-gray-400">Belum ada karya untuk filter ini.</div>
        @endif
    </div>
</section>
@endsection
