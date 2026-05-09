@extends('layouts.app')

@section('title', ($currentCategoryName ?? null) ? $currentCategoryName . ' Frozen Food Balikpapan | Mhika Frozen Food' : 'Produk Frozen Food Balikpapan | Mhika Frozen Food')
@section('meta_description', ($currentCategoryName ?? null) ? 'Lihat pilihan ' . $currentCategoryName . ' frozen food di Balikpapan dari Mhika Frozen Food dengan harga terjangkau.' : 'Lihat katalog produk frozen food Mhika Balikpapan seperti nugget, sosis, bakso, kentang, dan aneka frozen food lainnya.')
@section('meta_keywords', 'produk frozen food balikpapan, katalog frozen food balikpapan, nugget balikpapan, sosis balikpapan, bakso balikpapan, supplier frozen food balikpapan')

@section('content')
    <div class="container-fluid page-header modern-page-header mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container">
            <span class="hero-eyebrow">Katalog Mhika</span>
            <h1 class="display-3 mb-3 animated slideInDown">{{ ($currentCategoryName ?? null) ? $currentCategoryName . ' Balikpapan' : 'Produk Frozen Food Balikpapan' }}</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a class="text-body" href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item text-dark active" aria-current="page">Produk</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="container-xxl py-5 modern-section">
        <div class="container">
            <div class="catalog-toolbar">
                <div class="row g-4 align-items-end">
                <div class="col-lg-5">
                    <div class="section-header text-start mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 500px;">
                        <span class="section-kicker">Cari Produk</span>
                        <h2 class="display-5 mb-3">Katalog Produk</h2>
                        <p>Cari produk atau pilih kategori untuk melihat produk frozen food yang tersedia.</p>
                    </div>
                </div>
                <div class="col-lg-7 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s">
                    <div class="filter-pills d-inline-flex flex-wrap gap-2 justify-content-lg-end mb-5">
                        <a class="btn btn-outline-primary border-2 {{ $selectedCategory ? '' : 'active' }}" href="{{ route('products.index', $search ? ['q' => $search] : []) }}">Semua</a>
                        @foreach ($categories as $category)
                            <a class="btn btn-outline-primary border-2 {{ $selectedCategory === $category->slug ? 'active' : '' }}" href="{{ route('categories.show', array_filter(['category' => $category->slug, 'q' => $search])) }}">{{ $category->name }}</a>
                        @endforeach
                    </div>
                </div>
                </div>

            <form id="productSearchForm" class="search-panel mb-4" action="{{ $productsBaseUrl ?? route('products.index') }}" method="GET">
                @if ($selectedCategory)
                    <input type="hidden" name="category" value="{{ $selectedCategory }}">
                @endif
                <div class="input-group input-group-lg">
                    <span class="input-group-text bg-white"><i class="fa fa-search text-primary"></i></span>
                    <input
                        id="productSearchInput"
                        type="search"
                        name="q"
                        class="form-control"
                        value="{{ $search }}"
                        placeholder="Cari sosis, nugget, bakso..."
                        autocomplete="off">
                </div>
            </form>
            </div>

            <div id="productResults" data-products-url="{{ $productsBaseUrl ?? route('products.index') }}">
                @include('products.partials.product-grid', ['products' => $products])
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('productSearchForm');
            const input = document.getElementById('productSearchInput');
            const results = document.getElementById('productResults');

            if (!form || !input || !results) return;

            let activeController = null;
            let searchTimer = null;

            const buildUrl = function (targetUrl) {
                const url = new URL(targetUrl || results.dataset.productsUrl, window.location.origin);
                const requestedPage = targetUrl ? url.searchParams.get('page') : null;
                const formData = new FormData(form);

                Array.from(url.searchParams.keys()).forEach(function (key) {
                    if (key !== 'category' && key !== 'q' && key !== 'page') {
                        return;
                    }
                    url.searchParams.delete(key);
                });

                formData.forEach(function (value, key) {
                    if (value) {
                        url.searchParams.set(key, value);
                    }
                });

                if (!targetUrl) {
                    url.searchParams.delete('page');
                } else if (requestedPage) {
                    url.searchParams.set('page', requestedPage);
                }

                return url;
            };

            const loadProducts = function (targetUrl, pushState = true) {
                const url = buildUrl(targetUrl);

                if (activeController) {
                    activeController.abort();
                }

                activeController = new AbortController();
                results.classList.add('opacity-50');

                fetch(url.toString(), {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    signal: activeController.signal,
                })
                    .then(function (response) {
                        if (!response.ok) throw new Error('Pencarian gagal');
                        return response.json();
                    })
                    .then(function (payload) {
                        results.innerHTML = payload.html;
                        if (pushState) {
                            window.history.replaceState({}, '', url.toString());
                        }
                    })
                    .catch(function (error) {
                        if (error.name !== 'AbortError') {
                            console.error(error);
                        }
                    })
                    .finally(function () {
                        results.classList.remove('opacity-50');
                    });
            };

            input.addEventListener('input', function () {
                clearTimeout(searchTimer);
                searchTimer = setTimeout(function () {
                    loadProducts(null);
                }, 250);
            });

            form.addEventListener('submit', function (event) {
                event.preventDefault();
                loadProducts(null);
            });

            results.addEventListener('click', function (event) {
                const link = event.target.closest('.pagination a');
                if (!link) return;

                event.preventDefault();
                loadProducts(link.href);
            });
        });
    </script>
@endpush
