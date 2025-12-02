@extends('layout')

@section('title', 'Detail Pengaduan (Admin)')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Pengaduan #{{ $pengaduan->id }}</h1>
    <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h5>{{ $pengaduan->laporan }}</h5>
        @if($pengaduan->foto)
            <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto" class="img-fluid mt-2 mb-3" style="max-width:300px;">
        @endif
        <p class="text-muted">Status: <strong>{{ $pengaduan->status }}</strong></p>
        <p class="text-muted">Pelapor: {{ $pengaduan->user->name ?? '-' }}</p>
    </div>
</div>

<div class="card">
    <div class="card-header">Percakapan</div>
    <div class="card-body">
        @if(isset($pengaduan->chats) && $pengaduan->chats->count() > 0)
            @foreach($pengaduan->chats as $chat)
                <div class="mb-3">
                    <div class="d-flex justify-content-between">
                        <strong>{{ $chat->user->name ?? 'User' }}</strong>
                        <small class="text-muted">{{ $chat->created_at->diffForHumans() }}</small>
                    </div>
                    <div>{{ $chat->pesan }}</div>
                </div>
            @endforeach
        @else
            <div class="text-center py-4 text-muted">Belum ada pesan</div>
        @endif
    </div>
</div>
@endsection
