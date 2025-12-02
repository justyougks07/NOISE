@extends('layout')

@section('title', 'Beranda - Sistem Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <div>
        <h1 class="h3 mb-0">
            <i class="bi bi-house me-2"></i>
            Halo, {{ Auth::user()->name }}!
        </h1>
        <p class="text-muted mb-0">Selamat datang di sistem pengaduan masyarakat</p>
    </div>
    <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-1"></i>
        Buat Pengaduan Baru
    </a>
</div>

<!-- Quick Stats -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Pengaduan</h6>
                        <h2 class="mb-0">{{ $total }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-megaphone fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Menunggu</h6>
                        <h2 class="mb-0">{{ $pending }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Diproses</h6>
                        <h2 class="mb-0">{{ $diproses }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-gear fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Selesai</h6>
                        <h2 class="mb-0">{{ $selesai }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Pengaduan Terbaru -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-clock-history me-2"></i>
                    Pengaduan Terbaru
                </h5>
                <a href="{{ route('user.riwayat.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="100">ID</th>
                                <th>Laporan</th>
                                <th width="150">Status</th>
                                <th width="150">Tanggal</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPengaduan as $pengaduan)
                            <tr>
                                <td><strong class="text-primary">#{{ $pengaduan->id }}</strong></td>
                                <td>{{ Str::limit($pengaduan->laporan, 70) }}</td>
                                <td>
                                    <span class="status-badge status-{{ str_replace(' ', '-', $pengaduan->status) }}">
                                        {{ $pengaduan->status }}
                                    </span>
                                </td>
                                <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('user.pengaduan.show', $pengaduan->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-inbox fs-1 text-muted mb-3 d-block"></i>
                                    <p class="text-muted mb-0">Belum ada pengaduan</p>
                                    <a href="{{ route('user.pengaduan.create') }}" class="btn btn-primary btn-sm mt-2">
                                        <i class="bi bi-plus-circle me-1"></i> Buat Pengaduan
                                    </a>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Chat Terbaru -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-chat-dots me-2"></i>
                    Pesan Terbaru
                </h5>
            </div>
            <div class="card-body">
                @forelse($recentChats as $chat)
                <div class="mb-3 pb-3 border-bottom">
                    <div class="d-flex justify-content-between mb-1">
                        <strong>Admin</strong>
                        <small class="text-muted">{{ $chat->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-1">{{ Str::limit($chat->pesan, 80) }}</p>
                    <small class="text-muted">
                        Pengaduan #{{ $chat->pengaduan_id }}
                    </small>
                </div>
                @empty
                <div class="text-center py-4">
                    <i class="bi bi-chat fs-1 text-muted mb-3 d-block"></i>
                    <p class="text-muted mb-0">Belum ada pesan</p>
                </div>
                @endforelse
                
                @if($recentChats->count() > 0)
                <div class="text-center mt-3">
                    <a href="{{ route('user.chat.index') }}" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-chat-left-text me-1"></i>
                        Lihat Semua Chat
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Panduan Pengaduan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Panduan Membuat Pengaduan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <div class="text-center">
                            <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-pencil fs-4"></i>
                            </div>
                            <h6>1. Tulis Laporan</h6>
                            <p class="text-muted small">Jelaskan masalah dengan jelas dan detail</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center">
                            <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-camera fs-4"></i>
                            </div>
                            <h6>2. Upload Foto</h6>
                            <p class="text-muted small">Lampirkan foto sebagai bukti pendukung</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center">
                            <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-clock fs-4"></i>
                            </div>
                            <h6>3. Tunggu Proses</h6>
                            <p class="text-muted small">Admin akan memproses dalam 1-3 hari kerja</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="text-center">
                            <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 60px; height: 60px;">
                                <i class="bi bi-chat fs-4"></i>
                            </div>
                            <h6>4. Pantau Progress</h6>
                            <p class="text-muted small">Cek status dan chat dengan admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() 
</script>
@endpush