<div class="row g-4">
    @forelse ($products as $product)
        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
            @include('products.partials.product-card', ['product' => $product])
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-light border mb-0">Produk tidak ditemukan.</div>
        </div>
    @endforelse
</div>

@if ($products->hasPages())
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links() }}
    </div>
@endif
