@extends('layout')

@section('title', 'Riwayat Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-clock-history me-2"></i>
        Riwayat Pengaduan
    </h1>
    <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Pengaduan Baru
    </a>
</div>

<!-- Filter -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-2">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Cari pengaduan..." name="search" value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <select class="form-select" name="status">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dalam pengerjaan" {{ request('status') == 'dalam pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="bulan">
                    <option value="">Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('bulan') == $i ? 'selected' : '' }}>
                            {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" name="tahun">
                    <option value="">Semua Tahun</option>
                    @for($i = date('Y'); $i >= 2020; $i--)
                        <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>
                            {{ $i }}
                        </option>
                    @endfor
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
                        <th width="80">ID</th>
                        <th>Deskripsi</th>
                        <th width="120">Foto</th>
                        <th width="150">Status</th>
                        <th width="150">Tanggal</th>
                        <th width="180" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengaduan as $item)
                    <tr>
                        <td><strong>#{{ $item->id }}</strong></td>
                        <td>
                            <div class="fw-semibold">{{ Str::limit($item->laporan, 100) }}</div>
                            @if($item->lokasi)
                                <small class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $item->lokasi }}</small>
                            @endif
                        </td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="Foto" class="img-thumbnail" style="width: 60px; height: 60px;">
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
                                <a href="{{ route('user.pengaduan.show', $item->id) }}" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($item->status == 'pending')
                                    <a href="{{ route('user.pengaduan.edit', $item->id) }}" class="btn btn-outline-warning" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                @endif
                                <a href="{{ route('user.chat.show', $item->id) }}" class="btn btn-outline-info" title="Chat">
                                    <i class="bi bi-chat"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted mb-0">Belum ada pengaduan</p>
                            <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary btn-sm mt-2">
                                <i class="bi bi-plus-circle me-1"></i> Buat Pengaduan Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    @if($pengaduan->hasPages())
    <div class="card-footer">
        <div class="d-flex justify-content-center">
            {{ $pengaduan->links() }}
        </div>
    </div>
    @endif
</div>