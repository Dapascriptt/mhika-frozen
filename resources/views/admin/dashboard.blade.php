@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    @php
        $statCards = [
            ['label' => 'Total Produk', 'value' => $stats['products'], 'icon' => 'fa-box', 'tone' => 'brick', 'href' => route('admin.products.index')],
            ['label' => 'Total Kategori', 'value' => $stats['categories'], 'icon' => 'fa-tags', 'tone' => 'gold', 'href' => route('admin.categories.index')],
            ['label' => 'Produk Aktif', 'value' => $stats['activeProducts'], 'icon' => 'fa-check-circle', 'tone' => 'green', 'href' => route('admin.products.index')],
            ['label' => 'Unggulan', 'value' => $stats['featuredProducts'], 'icon' => 'fa-star', 'tone' => 'purple', 'href' => route('admin.products.index')],
        ];
        $activePercent = $stats['products'] > 0 ? round(($stats['activeProducts'] / $stats['products']) * 100) : 0;
        $featuredPercent = $stats['products'] > 0 ? round(($stats['featuredProducts'] / $stats['products']) * 100) : 0;
    @endphp

    <section class="admin-hero mb-4">
        <div>
            <span class="admin-page-kicker">Ringkasan Operasional</span>
            <h2 class="mb-2">Kelola katalog frozen food dari satu tempat.</h2>
            <p class="mb-0">Pantau produk dan kategori tanpa memuat plugin berat.</p>
        </div>
        <div class="admin-hero-actions">
            <a class="btn btn-light" href="{{ route('admin.products.create') }}"><i class="fa fa-plus me-2"></i>Produk Baru</a>
            <a class="btn btn-outline-light" href="{{ route('home') }}" target="_blank"><i class="fa fa-external-link-alt me-2"></i>Lihat Website</a>
        </div>
    </section>

    <div class="row g-4 mb-4">
        @foreach ($statCards as $card)
            <div class="col-md-6 col-xl-4">
                <a class="stat-card stat-card-{{ $card['tone'] }}" href="{{ $card['href'] }}">
                    <div class="stat-icon">
                        <i class="fa {{ $card['icon'] }}"></i>
                    </div>
                    <div>
                        <span>{{ $card['label'] }}</span>
                        <strong>{{ number_format($card['value'], 0, ',', '.') }}</strong>
                    </div>
                    <i class="fa fa-arrow-right stat-arrow"></i>
                </a>
            </div>
        @endforeach
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="admin-panel h-100">
                <div class="panel-heading">
                    <div>
                        <span class="admin-page-kicker">Status Produk</span>
                        <h3>Produk Aktif</h3>
                    </div>
                    <strong>{{ $activePercent }}%</strong>
                </div>
                <div class="progress admin-progress">
                    <div class="progress-bar" style="width: {{ $activePercent }}%"></div>
                </div>
                <p class="text-muted mb-0">{{ $stats['activeProducts'] }} dari {{ $stats['products'] }} produk sedang aktif di katalog publik.</p>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="admin-panel h-100">
                <div class="panel-heading">
                    <div>
                        <span class="admin-page-kicker">Sorotan</span>
                        <h3>Produk Unggulan</h3>
                    </div>
                    <strong>{{ $featuredPercent }}%</strong>
                </div>
                <div class="progress admin-progress admin-progress-warning">
                    <div class="progress-bar" style="width: {{ $featuredPercent }}%"></div>
                </div>
                <p class="text-muted mb-0">{{ $stats['featuredProducts'] }} dari {{ $stats['products'] }} produk ditandai sebagai unggulan.</p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-xl-7">
            <div class="admin-panel h-100">
                <div class="panel-heading">
                    <div>
                        <span class="admin-page-kicker">Produk Terbaru</span>
                        <h3>Update Katalog</h3>
                    </div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.products.index') }}">Lihat Semua</a>
                </div>
                <div class="table-responsive">
                    <table class="table admin-table align-middle mb-0">
                        <tbody>
                            @forelse ($latestProducts as $product)
                                <tr>
                                    <td>
                                        <strong>{{ $product->name }}</strong>
                                        <div class="text-muted small">{{ $product->category->name ?? 'Tanpa Kategori' }}</div>
                                    </td>
                                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="status-dot {{ $product->is_active ? 'is-on' : 'is-off' }}"></span>
                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </td>
                                    <td class="text-end">
                                        <a class="btn btn-sm btn-light" href="{{ route('admin.products.edit', $product) }}">Edit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center text-muted py-4">Belum ada produk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-5">
            <div class="admin-panel h-100">
                <div class="panel-heading">
                    <div>
                        <span class="admin-page-kicker">Kategori Terbaru</span>
                        <h3>Struktur Katalog</h3>
                    </div>
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.categories.index') }}">Lihat Semua</a>
                </div>
                <div class="message-list">
                    @forelse ($latestCategories as $category)
                        <a class="message-item" href="{{ route('admin.categories.edit', $category) }}">
                            <span class="message-avatar">{{ strtoupper(substr($category->name, 0, 1)) }}</span>
                            <span>
                                <strong>{{ $category->name }}</strong>
                                <small>{{ $category->products_count }} produk</small>
                            </span>
                            <em>Edit</em>
                        </a>
                    @empty
                        <div class="text-center text-muted py-4">Belum ada kategori.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
