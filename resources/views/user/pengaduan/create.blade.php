@extends('layout')

@section('title', 'Buat Pengaduan Baru')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-plus-circle me-2"></i>
        Buat Pengaduan Baru
    </h1>
    <a href="{{ route('user.riwayat.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="laporan" class="form-label">Deskripsi Pengaduan <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="laporan" name="laporan" rows="8" required 
                                  placeholder="Jelaskan masalah yang Anda alami dengan jelas dan lengkap. Contoh: Lokasi, waktu kejadian, dampak yang ditimbulkan, dll."></textarea>
                        <small class="text-muted">Minimal 50 karakter</small>
                    </div>
                    
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi Kejadian</label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" 
                               placeholder="Contoh: Jl. Merdeka No. 10, Kelurahan Sukajadi">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Upload Foto Bukti</label>
                        <div class="border rounded p-3 text-center">
                            <i class="bi bi-cloud-arrow-up fs-1 text-muted mb-3 d-block"></i>
                            <p class="text-muted small mb-3">Drag & drop atau klik untuk upload foto</p>
                            <input type="file" class="form-control" id="foto" name="foto" accept="image/*">
                            <small class="text-muted d-block mt-2">Format: JPG, PNG, maksimal 2MB</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" id="kategori" name="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="infrastruktur">Infrastruktur</option>
                            <option value="kebersihan">Kebersihan</option>
                            <option value="keamanan">Keamanan</option>
                            <option value="kesehatan">Kesehatan</option>
                            <option value="pendidikan">Pendidikan</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="prioritas" class="form-label">Prioritas</label>
                        <select class="form-select" id="prioritas" name="prioritas">
                            <option value="normal">Normal</option>
                            <option value="tinggi">Tinggi</option>
                            <option value="darurat">Darurat</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="alert alert-info">
                <i class="bi bi-info-circle me-2"></i>
                Pengaduan Anda akan diproses dalam 1-3 hari kerja. Anda dapat memantau status pengaduan dan berkomunikasi dengan admin melalui fitur chat.
            </div>
            
            <div class="d-flex justify-content-between">
                <button type="reset" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-1"></i> Batal
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-send me-1"></i> Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection