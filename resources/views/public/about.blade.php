@extends('layouts.app')
@section('title', 'Tentang Kami — Gandeng Tangan')

@section('content')
<section class="py-16 text-white" style="background: linear-gradient(135deg, #0d9488, #0f766e)">
    <div class="max-w-7xl mx-auto px-4">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Tentang <span class="text-amber-300">Gandeng Tangan</span></h1>
        <p class="text-white/80 max-w-2xl text-lg">
            Kami percaya bahwa setiap individu memiliki potensi kreatif yang luar biasa. Gandeng Tangan hadir untuk menjembatani karya seni anak-anak disabilitas Indonesia dengan apresiasi yang layak.
        </p>
    </div>
</section>

<section class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid md:grid-cols-3 gap-8 mb-16">
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                <div class="text-4xl mb-4">🎨</div>
                <h3 class="text-lg font-bold mb-2">Kreativitas Inklusif</h3>
                <p class="text-gray-500 text-sm">Membuka ruang ekspresi seni tanpa memandang keterbatasan fisik maupun mental.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                <div class="text-4xl mb-4">💰</div>
                <h3 class="text-lg font-bold mb-2">Pemberdayaan Ekonomi</h3>
                <p class="text-gray-500 text-sm">Memberikan sumber penghasilan mandiri melalui penjualan karya seni.</p>
            </div>
            <div class="bg-white rounded-2xl p-8 shadow-sm text-center">
                <div class="text-4xl mb-4">🤝</div>
                <h3 class="text-lg font-bold mb-2">Jaringan Kolaborasi</h3>
                <p class="text-gray-500 text-sm">Menghubungkan organisasi, sekolah khusus, dan seniman dalam satu ekosistem.</p>
            </div>
        </div>

        <h2 class="text-2xl font-bold mb-6">Organisasi Mitra Kami</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($organizations as $org)
                <div class="bg-white rounded-xl p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <span class="text-2xl">{{ $org->icon }}</span>
                        <h3 class="font-bold">{{ $org->name }}</h3>
                    </div>
                    <p class="text-sm text-gray-500 mb-3">{{ $org->description }}</p>
                    <div class="flex gap-4 text-xs text-gray-400">
                        <span>🎨 {{ $org->artists_count }} seniman</span>
                        <span>🖼 {{ $org->products_count }} karya</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
