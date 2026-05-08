@php
    $image = $product->image;
    $candidatePaths = $image
        ? (\Illuminate\Support\Str::startsWith($image, ['assets/', 'images/'])
            ? [$image]
            : ['images/products/thumbs/' . $image, 'images/products/originals/' . $image])
        : [];
    $imagePath = collect($candidatePaths)->first(fn ($path) => file_exists(public_path($path))) ?? 'assets/img/product-1.jpg';
    $whatsappMessage = 'Halo Mhika Frozen Food, saya mau order ' . $product->name . '.';
    $whatsappUrl = 'https://wa.me/6281347801998?text=' . rawurlencode($whatsappMessage);
@endphp

<div class="product-item h-100">
    <div class="position-relative bg-light overflow-hidden">
        <img
            class="img-fluid w-100"
            src="{{ asset($imagePath) }}"
            alt="{{ $product->name }} Frozen Food Balikpapan"
            loading="lazy"
            width="300"
            height="300">
        @if ($product->is_featured)
            <div class="bg-secondary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">Unggulan</div>
        @endif
    </div>
    <div class="product-card-body text-center p-4">
        <h3 class="h5 mb-2">
            <a class="text-body" href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>
        <p class="product-card-price mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
        <p class="product-card-category mb-0">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
    </div>
    <div class="product-card-action d-flex border-top">
        <small class="w-100 text-center py-2">
            <a class="text-body" href="{{ $whatsappUrl }}" target="_blank" rel="noopener"><i class="fab fa-whatsapp text-primary me-2"></i>Order</a>
        </small>
    </div>
</div>
