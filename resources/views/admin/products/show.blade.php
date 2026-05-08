@extends('admin.layouts.app')

@section('title', 'Detail Produk')
@section('page_title', 'Detail Produk')

@section('content')
    @php
        $detailImagePaths = \Illuminate\Support\Str::startsWith($product->image ?? '', ['assets/', 'images/'])
            ? [$product->image]
            : ['images/products/originals/' . $product->image, 'images/products/thumbs/' . $product->image];
        $detailImage = collect($detailImagePaths)->first(fn ($path) => $path && file_exists(public_path($path))) ?? 'assets/img/product-1.jpg';
    @endphp

    <div class="bg-white border rounded p-4">
        <div class="row g-4">
            <div class="col-md-4">
                <img class="img-fluid rounded border" src="{{ asset($detailImage) }}" alt="{{ $product->name }}">
            </div>
            <div class="col-md-8">
                <h2 class="h4">{{ $product->name }}</h2>
                <p class="text-muted mb-2">{{ $product->category->name ?? 'Tanpa Kategori' }}</p>
                <p class="h5 text-primary">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <div class="mb-3">
                    <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                    @if ($product->is_featured)
                        <span class="badge bg-warning text-dark">Unggulan</span>
                    @endif
                </div>
                <p>{{ $product->description ?: 'Tidak ada deskripsi.' }}</p>
                <a class="btn btn-primary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                <a class="btn btn-outline-secondary" href="{{ route('admin.products.index') }}">Kembali</a>
            </div>
        </div>
    </div>
@endsection
