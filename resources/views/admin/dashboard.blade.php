@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
    <div class="row g-4">
        @foreach ([
            'Total Produk' => $stats['products'],
            'Total Kategori' => $stats['categories'],
            'Total Pesan' => $stats['messages'],
            'Pesan Belum Dibaca' => $stats['unreadMessages'],
            'Produk Aktif' => $stats['activeProducts'],
            'Produk Unggulan' => $stats['featuredProducts'],
        ] as $label => $value)
            <div class="col-md-6 col-xl-4">
                <div class="bg-white border rounded p-4 h-100">
                    <span class="text-muted">{{ $label }}</span>
                    <div class="display-6 fw-bold mt-2">{{ $value }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
