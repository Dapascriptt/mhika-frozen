@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page_title', 'Produk')

@section('content')
    <div class="admin-panel mb-4">
        <div class="row g-3 align-items-center">
            <div class="col-lg-7">
                <form action="{{ route('admin.products.index') }}" method="GET" class="admin-search-form">
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa fa-search text-primary"></i></span>
                        <input
                            type="search"
                            name="q"
                            value="{{ $search }}"
                            class="form-control"
                            placeholder="Cari nama produk, kategori, atau deskripsi..."
                            autocomplete="off">
                        @if ($search)
                            <a class="btn btn-outline-secondary" href="{{ route('admin.products.index') }}">Reset</a>
                        @endif
                        <button class="btn btn-primary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5 text-lg-end">
                <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                    <i class="fa fa-plus me-2"></i>Tambah Produk
                </a>
            </div>
        </div>

        @if ($search)
            <p class="admin-search-note mb-0 mt-3">
                Menampilkan {{ $products->total() }} hasil untuk <strong>"{{ $search }}"</strong>.
            </p>
        @endif
    </div>

    <div class="bg-white border rounded table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Status</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($products as $product)
                    @php
                        $imagePaths = \Illuminate\Support\Str::startsWith($product->image ?? '', ['assets/', 'images/'])
                            ? [$product->image]
                            : ['images/products/thumbs/' . $product->image, 'images/products/originals/' . $product->image];
                        $image = collect($imagePaths)->first(fn ($path) => $path && file_exists(public_path($path))) ?? 'assets/img/product-1.jpg';
                    @endphp
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <img class="rounded border" src="{{ asset($image) }}" alt="{{ $product->name }}" loading="lazy" width="64" height="64">
                                <div>
                                    <div class="fw-semibold">{{ $product->name }}</div>
                                    @if ($product->is_featured)
                                        <span class="badge bg-warning text-dark">Unggulan</span>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->category->name ?? 'Tanpa Kategori' }}</td>
                        <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</span>
                        </td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.products.show', $product) }}">Detail</a>
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                            <form class="d-inline" action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">
                            {{ $search ? 'Produk tidak ditemukan.' : 'Produk belum tersedia.' }}
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
