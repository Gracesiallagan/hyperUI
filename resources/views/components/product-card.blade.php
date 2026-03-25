<div class="group bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300">
    <a href="{{ route('product.show', $product) }}">
        <div class="relative aspect-[4/3] overflow-hidden bg-gray-100">
            @if($product->image)
                <img src="{{ str_starts_with($product->image, 'http') ? $product->image : asset('storage/' . $product->image) }}"
                     alt="{{ $product->title }}"
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                     loading="lazy">
            @else
                <div class="w-full h-full flex items-center justify-center text-gray-300 text-sm">No Image</div>
            @endif
            @if($product->is_sold)
                <div class="absolute top-3 right-3 bg-red-500 text-white text-xs px-2 py-1 rounded-full">Terjual</div>
            @endif
            <div class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs px-2 py-1 rounded-full font-medium text-gray-700">
                {{ $product->category }}
            </div>
        </div>
        <div class="p-4">
            <h3 class="font-semibold text-gray-900 mb-1 group-hover:text-teal-600 transition">{{ $product->title }}</h3>
            <p class="text-xs text-gray-400 mb-2">{{ $product->medium }}</p>
            <div class="flex items-center justify-between">
                <span class="font-bold text-teal-600">{{ $product->formatted_price }}</span>
                <div class="flex items-center gap-1.5">
                    <div class="w-5 h-5 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-[10px] font-bold">
                        {{ $product->artist->avatar }}
                    </div>
                    <span class="text-xs text-gray-400">{{ $product->artist->name }}</span>
                </div>
            </div>
        </div>
    </a>
</div>
