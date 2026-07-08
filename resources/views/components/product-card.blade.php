<a class="card home-product" href="{{ route('product.show', $product) }}">
    <div class="home-product-media artwork-media-wrap">
        @if($product->image_url)
            <img src="{{ $product->image_url }}" alt="{{ $product->title }}" loading="lazy">
        @else
            <div class="home-product-fallback">IMG</div>
        @endif

        @if($product->is_sold)
            <span class="media-badge badge badge-sold">Sold Out</span>
        @endif
    </div>

    <div class="home-product-body">
        <div class="home-product-title">{{ $product->title }}</div>
        <div class="home-product-meta">
            <span class="pill">{{ $product->category->name ?? '-' }}</span>
            <span class="muted">{{ $product->artist->name ?? '-' }}</span>
        </div>
        <div class="home-product-price">{{ $product->formatted_price }}</div>
    </div>
</a>
