@extends('admin.layouts.app')

@section('title', 'Pesan Contact')
@section('page_title', 'Pesan Contact')

@section('content')
    <div class="bg-white border rounded table-responsive">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Pengirim</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $message)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $message->name }}</div>
                            <div class="text-muted small">{{ $message->email }}</div>
                        </td>
                        <td>{{ $message->subject ?: '-' }}</td>
                        <td>
                            <span class="badge {{ $message->is_read ? 'bg-secondary' : 'bg-primary' }}">{{ $message->is_read ? 'Dibaca' : 'Baru' }}</span>
                        </td>
                        <td>{{ $message->created_at->format('d M Y H:i') }}</td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.messages.show', $message) }}">Detail</a>
                            <form class="d-inline" action="{{ route('admin.messages.destroy', $message) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Pesan belum tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $messages->links() }}
    </div>
@endsection
