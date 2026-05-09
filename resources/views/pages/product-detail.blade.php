@extends('layouts.app')

@section('title', $product->name . ' Frozen Food Balikpapan | Mhika Frozen Food')
@section('meta_description', 'Beli ' . $product->name . ' di Mhika Frozen Food Balikpapan. ' . \Illuminate\Support\Str::limit(strip_tags($product->description ?: 'Produk frozen food berkualitas dengan harga terjangkau.'), 120))
@section('meta_keywords', $product->name . ' balikpapan, frozen food balikpapan, ' . ($product->category->name ?? 'produk frozen food') . ' balikpapan, mhika frozen food')

@section('content')
    @php
        $image = $product->image;
        $candidatePaths = $image
            ? (\Illuminate\Support\Str::startsWith($image, ['assets/', 'images/'])
                ? [$image]
                : ['images/products/originals/' . $image, 'images/products/thumbs/' . $image])
            : [];
        $imagePath = collect($candidatePaths)->first(fn ($path) => file_exists(public_path($path))) ?? 'assets/img/product-1.jpg';
        $whatsappMessage = 'Halo Mhika Frozen Food, saya mau order ' . $product->name . '.';
        $whatsappUrl = 'https://wa.me/6281347801998?text=' . rawurlencode($whatsappMessage);
    @endphp

    <div class="container-fluid page-header modern-page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <span class="hero-eyebrow">Detail Produk</span>
            <h1 class="display-3 mb-3 animated slideInDown">{{ $product->name }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item"><a class="text-body" href="{{ route('products.index') }}">Produk</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-5 modern-section">
        <div class="container">
            <div class="product-detail-panel row g-5 align-items-start">
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <img
                        class="product-detail-image img-fluid w-100"
                        src="{{ asset($imagePath) }}"
                        alt="{{ $product->name }} Frozen Food Balikpapan"
                        width="600"
                        height="600">
                </div>
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <p class="product-category-label mb-2">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                    <h2 class="display-5 mb-3">{{ $product->name }}</h2>
                    <p class="h3 text-primary mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p>{{ $product->description ?: 'Produk frozen food berkualitas dari Mhika Frozen Food Balikpapan.' }}</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="{{ $whatsappUrl }}" target="_blank" rel="noopener">
                        <i class="fab fa-whatsapp me-2"></i>Pesan via WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>

    @if ($relatedProducts->isNotEmpty())
        <div class="container-xxl py-5">
            <div class="container">
                <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                    <h2 class="display-5 mb-3">Produk Terkait</h2>
                    <p>Pilihan frozen food Balikpapan lain dari kategori yang sama.</p>
                </div>
                <div class="row g-4">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            @include('products.partials.product-card', ['product' => $relatedProduct])
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
@endsection
