@extends('layout')

@section('title', 'Pengaduan - Sistem Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-megaphone me-2"></i>
        Pengaduan
    </h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPengaduanModal">
        <i class="bi bi-plus-circle me-1"></i>
        Tambah Pengaduan
    </button>
</div>

<!-- Filter Section -->
<div class="card mb-4">
    <div class="card-body">
        <form class="row g-3">
            <div class="col-md-3">
                <label for="search" class="form-label">Cari</label>
                <input type="text" class="form-control" id="search" placeholder="Cari pengaduan...">
            </div>
            <div class="col-md-2">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status">
                    <option value="">Semua Status</option>
                    <option value="pending">Pending</option>
                    <option value="dalam pengerjaan">Dalam Pengerjaan</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>
            <div class="col-md-2">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" class="form-control" id="tanggal_mulai">
            </div>
            <div class="col-md-2">
                <label for="tanggal_selesai" class="form-label">Tanggal Selesai</label>
                <input type="date" class="form-control" id="tanggal_selesai">
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary me-2">
                    <i class="bi bi-filter me-1"></i> Filter
                </button>
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-clockwise"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Pengaduan Table -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Daftar Pengaduan</h5>
            <span class="text-muted">Total: 24 pengaduan</span>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th width="80">ID</th>
                        <th width="150">Nama Pelapor</th>
                        <th>Laporan</th>
                        <th width="100">Foto</th>
                        <th width="150">Status</th>
                        <th width="150">Tanggal</th>
                        <th width="120" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong class="text-primary">#101</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    BS
                                </div>
                                <span>Budi Santoso</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">Jalan Berlubang</div>
                            <small class="text-muted">Jalan depan sekolah SDN 01 berlubang besar, berbahaya untuk siswa...</small>
                        </td>
                        <td>
                            <img src="https://via.placeholder.com/50x50/007bff/ffffff?text=JL" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <span class="status-badge status-pending">pending</span>
                        </td>
                        <td>
                            <div>29 Nov 2024</div>
                            <small class="text-muted">10:30 WIB</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">#100</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    SR
                                </div>
                                <span>Siti Rahayu</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">Lampu Jalan Mati</div>
                            <small class="text-muted">Lampu jalan di komplek Permata Indah mati total sejak 3 hari...</small>
                        </td>
                        <td>
                            <img src="https://via.placeholder.com/50x50/28a745/ffffff?text=LP" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <span class="status-badge status-progress">dalam pengerjaan</span>
                        </td>
                        <td>
                            <div>28 Nov 2024</div>
                            <small class="text-muted">14:20 WIB</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-success" title="Chat">
                                    <i class="bi bi-chat"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">#99</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    AW
                                </div>
                                <span>Agus Wijaya</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">Sampah Menumpuk</div>
                            <small class="text-muted">Sampah menumpuk di TPS RW 05 sudah 1 minggu tidak diangkut...</small>
                        </td>
                        <td>
                            <img src="https://via.placeholder.com/50x50/ffc107/000000?text=SM" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <span class="status-badge status-selesai">selesai</span>
                        </td>
                        <td>
                            <div>27 Nov 2024</div>
                            <small class="text-muted">09:15 WIB</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary" title="Arsip">
                                    <i class="bi bi-archive"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong class="text-primary">#98</strong></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-info text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    DL
                                </div>
                                <span>Dewi Lestari</span>
                            </div>
                        </td>
                        <td>
                            <div class="fw-semibold">Air PDAM Keruh</div>
                            <small class="text-muted">Air PDAM keruh dan berbau sejak 3 hari yang lalu, daerah Perumahan...</small>
                        </td>
                        <td>
                            <img src="https://via.placeholder.com/50x50/17a2b8/ffffff?text=AP" alt="Foto" class="img-thumbnail" style="width: 50px; height: 50px;">
                        </td>
                        <td>
                            <span class="status-badge status-progress">dalam pengerjaan</span>
                        </td>
                        <td>
                            <div>26 Nov 2024</div>
                            <small class="text-muted">16:45 WIB</small>
                        </td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-outline-primary" title="Lihat">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-outline-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-outline-success" title="Chat">
                                    <i class="bi bi-chat"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Modal Tambah Pengaduan -->
<div class="modal fade" id="tambahPengaduanModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i>
                    Tambah Pengaduan Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_pelapor" class="form-label">Nama Pelapor</label>
                        <input type="text" class="form-control" id="nama_pelapor" required>
                    </div>
                    <div class="mb-3">
                        <label for="laporan" class="form-label">Laporan</label>
                        <textarea class="form-control" id="laporan" rows="4" required placeholder="Jelaskan masalah secara detail..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto</label>
                        <input type="file" class="form-control" id="foto" accept="image/*">
                        <small class="text-muted">Format: JPG, PNG, maksimal 2MB</small>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <select class="form-select" id="kategori">
                                <option value="">Pilih Kategori</option>
                                <option value="infrastruktur">Infrastruktur</option>
                                <option value="kebersihan">Kebersihan</option>
                                <option value="utilitas">Utilitas</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="prioritas" class="form-label">Prioritas</label>
                            <select class="form-select" id="prioritas">
                                <option value="normal">Normal</option>
                                <option value="tinggi">Tinggi</option>
                                <option value="darurat">Darurat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Pengaduan</button>
                </div>
            </form>
        </div>
    </div>
</div>