@extends('admin.layouts.app')

@section('title', 'Produk')
@section('page_title', 'Produk')

@section('content')
    <div class="d-flex justify-content-end mb-3">
        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">Tambah Produk</a>
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
                        <td colspan="5" class="text-center py-4">Produk belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
@endsection
