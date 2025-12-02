@extends('layout')

@section('title', 'Kelola Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-megaphone me-2"></i>
        Kelola Pengaduan
    </h1>
    <div class="btn-group">
        <a href="{{ route('admin.reports.export') }}" class="btn btn-outline-success">
            <i class="bi bi-download me-1"></i> Export
        </a>
    </div>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Cari pengaduan..." name="search" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dalam pengerjaan" {{ request('status') == 'dalam pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="start_date" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-2">
                <input type="date" class="form-control" name="end_date" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-2">
                <select class="form-select" name="user">
                    <option value="">Semua User</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-filter"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Daftar Pengaduan -->
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="60">ID</th>
                        <th width="150">Pelapor</th>
                        <th>Laporan</th>
                        <th width="100">Foto</th>
                        <th width="150">Status</th>
                        <th width="150">Tanggal</th>
                        <th width="200" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengaduan as $item)
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    {{ strtoupper(substr($item->user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div>{{ $item->user->name }}</div>
                                    <small class="text-muted">{{ $item->user->email }}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ Str::limit($item->laporan, 80) }}</div>
                            @if($item->lokasi)
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $item->lokasi }}</small>
                            @endif
                        </td>
                        <td>
                            @if($item->foto)
                                <a href="{{ asset('storage/' . $item->foto) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="img-thumbnail" style="width: 60px; height: 60px;">
                                </a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <span class="status-badge status-{{ str_replace(' ', '-', $item->status) }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td>
                            <div>{{ $item->created_at->format('d/m/Y') }}</div>
                            <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('admin.pengaduan.show', $item->id) }}" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('admin.pengaduan.edit', $item->id) }}" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="{{ route('admin.chat.show', $item->id) }}" class="btn btn-outline-info" title="Chat">
                                    <i class="bi bi-chat"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                            
                            <!-- Modal Delete -->
                            <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah Anda yakin ingin menghapus pengaduan #{{ $item->id }} dari {{ $item->user->name }}?
                                            <div class="alert alert-warning mt-2">
                                                <i class="bi bi-exclamation-triangle me-2"></i>
                                                Tindakan ini akan menghapus semua data terkait termasuk chat.
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <form action="{{ route('admin.pengaduan.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    @if($pengaduan->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                Menampilkan {{ $pengaduan->firstItem() }} - {{ $pengaduan->lastItem() }} dari {{ $pengaduan->total() }} pengaduan
            </div>
            <div>
                {{ $pengaduan->links() }}
            </div>
        </div>
    </div>
    @endif
</div>
@endsection