@extends('layouts.app')
@section('title', $product->title . ' — Gandeng Tangan')

@section('content')
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4">
        <a href="{{ route('gallery') }}" class="text-teal-600 text-sm mb-6 inline-block">&larr; Kembali ke Galeri</a>

        <div class="grid md:grid-cols-2 gap-12">
            <div class="rounded-2xl overflow-hidden bg-gray-100">
                @if($product->image)
                    <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                         alt="{{ $product->title }}" class="w-full h-auto object-cover">
                @else
                    <div class="aspect-square flex items-center justify-center text-gray-300">No Image</div>
                @endif
            </div>
            <div>
                <span class="inline-block px-3 py-1 bg-teal-50 text-teal-700 rounded-full text-xs font-medium mb-3">{{ $product->category->name ?? '-' }}</span>
                @if($product->is_sold)
                    <span class="inline-block px-3 py-1 bg-red-50 text-red-600 rounded-full text-xs font-medium mb-3 ml-2">Terjual</span>
                @endif
                <h1 class="text-3xl font-bold mb-2">{{ $product->title }}</h1>
                <p class="text-gray-500 mb-4">{{ $product->medium }}</p>
                <div class="text-2xl font-bold text-teal-600 mb-6">{{ $product->formatted_price }}</div>

                @if($product->description)
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                @endif

                {{-- Artist Info --}}
                <div class="bg-gray-50 rounded-xl p-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold">
                            {{ $product->artist->avatar }}
                        </div>
                        <div>
                            <div class="font-semibold">{{ $product->artist->name }}</div>
                            <div class="text-xs text-gray-400">{{ $product->artist->disability_type }} · {{ $product->artist->organization->name }}</div>
                        </div>
                    </div>
                </div>

                @unless($product->is_sold)
<a href="https://wa.me/{{ config('app.whatsapp_number', env('WHATSAPP_NUMBER', '6282163850914')) }}?text={{ urlencode(env('WHATSAPP_DEFAULT_TEXT', 'Halo admin GandengTangan, saya ingin pesan karya ini:') . ' ' . $product->title) }}"                       target="_blank"
                       class="inline-flex items-center gap-2 px-6 py-3 text-white font-semibold rounded-full transition"
                       style="background: var(--color-primary)">
                        💬 Hubungi via WhatsApp
                    </a>
                @endunless
            </div>
        </div>

        {{-- Related Products --}}
        @if($related->count() > 0)
            <div class="mt-16">
                <h2 class="text-xl font-bold mb-6">Karya Serupa</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($related as $p)
                        @include('components.product-card', ['product' => $p])
                    @endforeach
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
