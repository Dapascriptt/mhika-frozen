@extends('layouts.app')

@section('title', 'Mhika Frozen Food Balikpapan | Supplier Frozen Food Murah')
@section('meta_description', 'Mhika Frozen Food Balikpapan menyediakan nugget, sosis, kentang, beef burger, ayam siap makan, dan aneka frozen food berkualitas dengan harga terjangkau.')
@section('meta_keywords', 'frozen food balikpapan, frozen food murah balikpapan, supplier frozen food balikpapan, jual frozen food balikpapan, frozen food terdekat balikpapan, mhika frozen food')

@section('content')
    <div class="container-fluid p-0 mb-5 wow fadeIn home-hero" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="w-100" src="{{ asset('assets/img/bg1.jpeg') }}" alt="Mhika Frozen Food" width="1920" height="900">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 hero-copy">
                                    <h1 class="display-2 mb-4 animated slideInDown">Mhika Frozen Food Balikpapan</h1>
                                    <p class="hero-lead animated slideInDown">Pilihan sosis, nugget, bakso, kentang, ayam siap makan, dan aneka frozen food untuk rumah maupun usaha.</p>
                                    <div class="d-flex flex-wrap gap-3 mt-4">
                                        <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill py-3 px-5">Lihat Katalog</a>
                                        <a href="{{ route('contact') }}" class="btn btn-light rounded-pill py-3 px-5">Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="w-100" src="{{ asset('assets/img/bg2.jpeg') }}" alt="Produk frozen food praktis" width="1920" height="900">
                    <div class="carousel-caption">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-lg-7 hero-copy">

                                    <div class="display-2 fw-bold mb-5 animated slideInDown">Stok Beku Praktis untuk Setiap Dapur</div>
                                    <a href="{{ route('products.index') }}" class="btn btn-primary rounded-pill py-sm-3 px-sm-5">Lihat Katalog</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Sebelumnya</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Berikutnya</span>
            </button>
        </div>
    </div>

    <div class="container-xxl py-5 modern-section">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img modern-image-frame position-relative overflow-hidden p-4">
                        <img class="img-fluid w-100" src="{{ asset('assets/img/frozen.jpeg') }}" alt="Pilihan frozen food Mhika" loading="lazy" width="600" height="600">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <span class="section-kicker">Kenapa Mhika</span>
                    <h2 class="display-5 mb-4">Frozen Food Praktis untuk Rumah dan Usaha di Balikpapan</h2>
                    <p class="mb-4">Mhika Frozen Food Balikpapan menyediakan produk beku siap masak untuk kebutuhan harian, bekal, dan stok usaha kuliner.</p>
                    <div class="feature-list">
                        <div><i class="fa fa-check"></i><span>Pilihan kategori lengkap</span></div>
                        <div><i class="fa fa-check"></i><span>Produk mudah disimpan dan cepat disajikan</span></div>
                    </div>
                    <a class="btn btn-primary rounded-pill py-3 px-5 mt-3" href="{{ route('products.index') }}">Lihat Produk</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl py-5 modern-section">
        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <span class="section-kicker">Rekomendasi</span>
                        <h2 class="display-5 mb-3">Produk Unggulan</h2>
                        <p>Produk pilihan dari database, siap dikembangkan untuk katalog penuh.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <a class="btn btn-outline-primary border-2 rounded-pill mb-5" href="{{ route('products.index') }}">Semua Produk</a>
                </div>
            </div>
            <div class="row g-4">
                @forelse ($featuredProducts as $product)
                    <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        @include('products.partials.product-card', ['product' => $product])
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-light border mb-0">Produk unggulan belum tersedia.</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light bg-icon my-5 py-6 modern-section">
        <div class="container">
            <div class="section-header text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                <span class="section-kicker">Kategori</span>
                <h2 class="display-5 mb-3">Kategori Frozen Food Balikpapan</h2>
                <p>Temukan produk berdasarkan kebutuhan dapur dan menu usaha.</p>
            </div>
            <div class="row g-4">
                @php
                    $categoryIcons = [
                        'sosis' => 'sosis.png',
                        'nugget' => 'nuggets.png',
                        'kentang' => 'kentang.png',
                        'ayam-siap-makan' => 'ayam.png',
                        'bakso' => 'bakso.png',
                        'aneka-frozen' => 'frozen-food.png',
                        'perdagingan' => 'meat.png',
                        'beef-burger' => 'burger.png',
                        'sayur-dan-buah' => 'sayurbuah.png',
                    ];
                @endphp
                @foreach ($categories as $category)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="category-card bg-white text-center h-100 p-4 p-xl-5 d-block text-body" href="{{ route('categories.show', $category->slug) }}">
                            <img
                                class="category-icon img-fluid mb-4"
                                src="{{ asset('assets/img/' . ($categoryIcons[$category->slug] ?? 'frozen-food.png')) }}"
                                alt="{{ $category->name }}"
                                loading="lazy"
                                width="96"
                                height="96">
                            <h4 class="mb-3">{{ $category->name }}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid bg-primary bg-icon mt-5 py-6 modern-cta">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-md-7 wow fadeIn" data-wow-delay="0.1s">
                    <h2 class="display-5 text-white mb-3">Butuh Supplier Frozen Food Balikpapan?</h2>
                    <p class="text-white mb-0">Hubungi Mhika Frozen Food untuk informasi produk, ketersediaan, dan pemesanan.</p>
                </div>
                <div class="col-md-5 text-md-end wow fadeIn" data-wow-delay="0.5s">
                    <a class="btn btn-lg btn-secondary rounded-pill py-3 px-5" href="{{ route('contact') }}">Hubungi Kami</a>
                </div>
            </div>
        </div>
    </div>
@endsection
