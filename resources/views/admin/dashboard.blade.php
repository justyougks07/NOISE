@extends('layout')

@section('title', 'Dashboard Admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard Admin
    </h1>
    <div class="btn-group">
        <button class="btn btn-outline-primary" onclick="window.print()">
            <i class="bi bi-printer me-1"></i> Cetak Laporan
        </button>
    </div>
</div>

<!-- Stats Overview -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card border-primary">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Total Pengaduan</h6>
                        <h2 class="mb-0">{{ $stats['total'] }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-megaphone fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-success">
                        <i class="bi bi-arrow-up"></i> {{ $stats['growth'] }}%
                    </span>
                    <span class="text-muted">dari bulan lalu</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Belum Diproses</h6>
                        <h2 class="mb-0">{{ $stats['pending'] }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    @if($stats['pending_growth'] > 0)
                        <span class="text-danger">
                            <i class="bi bi-arrow-up"></i> {{ $stats['pending_growth'] }}%
                        </span>
                    @else
                        <span class="text-success">
                            <i class="bi bi-arrow-down"></i> {{ abs($stats['pending_growth']) }}%
                        </span>
                    @endif
                    <span class="text-muted">dari minggu lalu</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-info">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Sedang Diproses</h6>
                        <h2 class="mb-0">{{ $stats['progress'] }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-info text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-gear fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-success">
                        <i class="bi bi-arrow-up"></i> {{ $stats['progress_growth'] }}%
                    </span>
                    <span class="text-muted">dari minggu lalu</span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card border-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="text-muted">Telah Selesai</h6>
                        <h2 class="mb-0">{{ $stats['completed'] }}</h2>
                    </div>
                    <div class="avatar avatar-lg bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <span class="text-success">
                        <i class="bi bi-arrow-up"></i> {{ $stats['completed_growth'] }}%
                    </span>
                    <span class="text-muted">dari minggu lalu</span>
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
                    <i class="bi bi-list-ul me-2"></i>
                    Pengaduan Terbaru
                </h5>
                <a href="{{ route('admin.pengaduan.index') }}" class="btn btn-sm btn-outline-primary">
                    Lihat Semua <i class="bi bi-arrow-right"></i>
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th width="80">ID</th>
                                <th>Pelapor</th>
                                <th>Laporan</th>
                                <th width="120">Status</th>
                                <th width="150">Tanggal</th>
                                <th width="100" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentPengaduan as $pengaduan)
                            <tr>
                                <td><strong>#{{ $pengaduan->id }}</strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                            {{ strtoupper(substr($pengaduan->user->name, 0, 1)) }}
                                        </div>
                                        <span>{{ $pengaduan->user->name }}</span>
                                    </div>
                                </td>
                                <td>{{ Str::limit($pengaduan->laporan, 50) }}</td>
                                <td>
                                    <span class="status-badge status-{{ str_replace(' ', '-', $pengaduan->status) }}">
                                        {{ $pengaduan->status }}
                                    </span>
                                </td>
                                <td>{{ $pengaduan->created_at->format('d/m/Y H:i') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Aktivitas Terbaru -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-activity me-2"></i>
                    Aktivitas Terbaru
                </h5>
            </div>
            <div class="card-body">
                @foreach($activities as $activity)
                <div class="mb-3">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-sm {{ $activity['type'] == 'chat' ? 'bg-info' : 'bg-success' }} text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                <i class="bi bi-{{ $activity['icon'] }}"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between">
                                <strong>{{ $activity['user'] }}</strong>
                                <small class="text-muted">{{ $activity['time'] }}</small>
                            </div>
                            <p class="mb-0">{{ $activity['message'] }}</p>
                            @if($activity['type'] == 'pengaduan')
                                <small class="text-muted">Pengaduan #{{ $activity['pengaduan_id'] }}</small>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<!-- Grafik Pengaduan -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="bi bi-bar-chart me-2"></i>
                    Statistik Pengaduan Bulan Ini
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Distribusi Status</h6>
                        <div class="d-flex align-items-center mb-2">
                            <div style="width: 100px;" class="me-3">Pending</div>
                            <div class="progress flex-grow-1" style="height: 20px;">
                                <div class="progress-bar bg-warning" style="width: {{ ($stats['pending']/$stats['total'])*100 }}%"></div>
                            </div>
                            <div class="ms-3">{{ $stats['pending'] }}</div>
                        </div>
                        <div class="d-flex align-items-center mb-2">
                            <div style="width: 100px;" class="me-3">Diproses</div>
                            <div class="progress flex-grow-1" style="height: 20px;">
                                <div class="progress-bar bg-info" style="width: {{ ($stats['progress']/$stats['total'])*100 }}%"></div>
                            </div>
                            <div class="ms-3">{{ $stats['progress'] }}</div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div style="width: 100px;" class="me-3">Selesai</div>
                            <div class="progress flex-grow-1" style="height: 20px;">
                                <div class="progress-bar bg-success" style="width: {{ ($stats['completed']/$stats['total'])*100 }}%"></div>
                            </div>
                            <div class="ms-3">{{ $stats['completed'] }}</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Top Kategori</h6>
                        @foreach($topCategories as $category)
                        <div class="d-flex justify-content-between mb-1">
                            <span>{{ $category['name'] }}</span>
                            <span>{{ $category['count'] }} pengaduan</span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection