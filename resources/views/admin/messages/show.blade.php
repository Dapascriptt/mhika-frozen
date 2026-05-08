@extends('admin.layouts.app')

@section('title', 'Detail Pesan')
@section('page_title', 'Detail Pesan')

@section('content')
    <div class="bg-white border rounded p-4">
        <div class="d-flex justify-content-between align-items-start mb-4">
            <div>
                <h2 class="h4 mb-1">{{ $contactMessage->subject ?: 'Tanpa Subject' }}</h2>
                <p class="text-muted mb-0">{{ $contactMessage->created_at->format('d M Y H:i') }}</p>
            </div>
            <form action="{{ route('admin.messages.destroy', $contactMessage) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-outline-danger" type="submit">Hapus</button>
            </form>
        </div>

        <dl class="row">
            <dt class="col-sm-2">Nama</dt>
            <dd class="col-sm-10">{{ $contactMessage->name }}</dd>
            <dt class="col-sm-2">Email</dt>
            <dd class="col-sm-10">{{ $contactMessage->email }}</dd>
            <dt class="col-sm-2">Pesan</dt>
            <dd class="col-sm-10">{{ $contactMessage->message }}</dd>
        </dl>

        <a class="btn btn-outline-secondary" href="{{ route('admin.messages.index') }}">Kembali</a>
    </div>
@endsection
