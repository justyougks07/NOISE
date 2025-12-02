@extends('layout')

@section('title', 'Token API - Sistem Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-key me-2"></i>
        Token API
    </h1>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTokenModal">
        <i class="bi bi-plus-circle me-1"></i>
        Buat Token Baru
    </button>
</div>

<div class="alert alert-info">
    <i class="bi bi-info-circle me-2"></i>
    Token API digunakan untuk mengakses API sistem. Token akan ditampilkan sekali saat dibuat.
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th width="200">Nama Token</th>
                        <th>Token</th>
                        <th width="150">Abilities</th>
                        <th width="150">Terakhir Digunakan</th>
                        <th width="150">Kadaluarsa</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <strong>Mobile App</strong><br>
                            <small class="text-muted">Created: 20 Nov 2024</small>
                        </td>
                        <td>
                            <code class="text-truncate d-inline-block" style="max-width: 150px;">
                                eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9...
                            </code>
                        </td>
                        <td>
                            <span class="badge bg-secondary me-1">read</span>
                            <span class="badge bg-secondary me-1">write</span>
                        </td>
                        <td>
                            <div>28 Nov 2024</div>
                            <small class="text-muted">14:30 WIB</small>
                        </td>
                        <td>
                            <span class="badge bg-success">30 Des 2024</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Integration Partner</strong><br>
                            <small class="text-muted">Created: 15 Nov 2024</small>
                        </td>
                        <td>
                            <code class="text-truncate d-inline-block" style="max-width: 150px;">
                                zxcvb12345qwerty67890asdfgh...
                            </code>
                        </td>
                        <td>
                            <span class="badge bg-secondary me-1">read</span>
                        </td>
                        <td>
                            <div>25 Nov 2024</div>
                            <small class="text-muted">09:15 WIB</small>
                        </td>
                        <td>
                            <span class="badge bg-warning">15 Jan 2025</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <strong>Backup System</strong><br>
                            <small class="text-muted">Created: 10 Nov 2024</small>
                        </td>
                        <td>
                            <code class="text-truncate d-inline-block" style="max-width: 150px;">
                                mnbvcxzlkjhgfdsa0987654321...
                            </code>
                        </td>
                        <td>
                            <span class="badge bg-secondary me-1">backup</span>
                        </td>
                        <td>
                            <div>26 Nov 2024</div>
                            <small class="text-muted">03:00 WIB</small>
                        </td>
                        <td>
                            <span class="text-muted">Tidak ada</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create Token -->
<div class="modal fade" id="createTokenModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="bi bi-plus-circle me-2"></i>
                    Buat Token API Baru
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tokens.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="token_name" class="form-label">Nama Token</label>
                        <input type="text" class="form-control" id="token_name" name="name" required placeholder="Contoh: Token Mobile App">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Permissions</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="abilities[]" value="read" id="read_permission" checked>
                            <label class="form-check-label" for="read_permission">
                                Read (Baca data)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="abilities[]" value="write" id="write_permission">
                            <label class="form-check-label" for="write_permission">
                                Write (Tulis data)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="abilities[]" value="delete" id="delete_permission">
                            <label class="form-check-label" for="delete_permission">
                                Delete (Hapus data)
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label">Tanggal Kadaluarsa (Opsional)</label>
                        <input type="date" class="form-control" id="expiry_date" name="expires_at">
                        <small class="text-muted">Biarkan kosong untuk token tanpa batas waktu</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Buat Token</button>
                </div>
            </form>
        </div>
    </div>
</div>