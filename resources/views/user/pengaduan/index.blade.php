@extends('layout')

@section('title', 'Pengaduan Saya')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">Pengaduan Saya</h1>
    <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">Buat Pengaduan</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th>Deskripsi</th>
                        <th width="120">Foto</th>
                        <th width="150">Status</th>
                        <th width="150">Tanggal</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $item)
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>
                        <td>{{ Str::limit($item->laporan, 100) }}</td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="img-thumbnail" style="width: 60px; height: 60px;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ str_replace(' ', '-', $item->status) }}">{{ $item->status }}</span>
                        </td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('user.pengaduan.show', $item->id) }}" class="btn btn-outline-primary">Lihat</a>
                                @if($item->status == 'pending')
                                    <a href="{{ route('user.pengaduan.edit', $item->id) }}" class="btn btn-outline-warning">Edit</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">Belum ada pengaduan</p>
                            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary btn-sm mt-2">Buat Pengaduan</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
