@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Kelola Pengaduan</h1>
            <p class="text-gray-600 mt-2">Tinjau dan kelola semua pengaduan yang masuk</p>
        </div>
        <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
            </svg>
            Export
        </a>
    </div>

    <!-- Filter Card -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Filter Pengaduan</h3>
        <form class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <input type="text" name="search" placeholder="Cari pengaduan..." value="{{ request('search') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="dalam pengerjaan" {{ request('status') == 'dalam pengerjaan' ? 'selected' : '' }}>Dalam Pengerjaan</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                    Cari
                </button>
                <a href="{{ route('admin.pengaduan.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg transition text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Pengaduan List -->
    @if($pengaduan->count() > 0)
        <div class="space-y-4">
            @foreach($pengaduan as $p)
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition border-l-4
                    @if($p->status === 'pending') border-yellow-500
                    @elseif($p->status === 'dalam pengerjaan') border-purple-500
                    @elseif($p->status === 'selesai') border-green-500
                    @endif
                ">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-3 mb-2">
                                    <span class="text-sm font-semibold text-gray-500">#{{ $p->id }}</span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($p->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($p->status === 'dalam pengerjaan') bg-purple-100 text-purple-800
                                        @elseif($p->status === 'selesai') bg-green-100 text-green-800
                                        @endif
                                    ">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                    <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="hover:text-blue-600">{{ Str::limit($p->laporan, 60) }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-3">Dari: <strong>{{ $p->user->name }}</strong> ({{ $p->user->email }})</p>
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($p->laporan, 120) }}</p>
                                
                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span>{{ $p->created_at->format('d M Y, H:i') }}</span>
                                    @if($p->chat->count() > 0)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                                <path d="M6 11a1 1 0 11-2 0 1 1 0 012 0zM12 11a1 1 0 11-2 0 1 1 0 012 0zM16 11a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                            </svg>
                                            {{ $p->chat->count() }} pesan
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex flex-col gap-2">
                                <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold py-2 px-4 rounded-lg transition text-center whitespace-nowrap">
                                    Tinjau Detail
                                </a>
                                @if($p->status !== 'selesai')
                                    <form action="{{ route('admin.pengaduan.updateStatus', $p->id) }}" method="POST" class="flex gap-1">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="flex-1 text-sm px-2 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <option value="pending" {{ $p->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="dalam pengerjaan" {{ $p->status === 'dalam pengerjaan' ? 'selected' : '' }}>Diproses</option>
                                            <option value="selesai" {{ $p->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-3 rounded-lg transition text-sm">
                                            Ubah
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            {{ $pengaduan->links() }}
        </div>
    @else
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pengaduan</h2>
            <p class="text-gray-600">Tidak ada pengaduan yang sesuai dengan filter Anda.</p>
        </div>
    @endif
</div>
@endsection
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