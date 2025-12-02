@extends('layout')

@section('title', 'Edit Pengaduan')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h4">Edit Pengaduan #{{ $pengaduan->id }}</h1>
    <a href="{{ route('user.riwayat.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="#" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Laporan</label>
                <textarea class="form-control" name="laporan" rows="5">{{ old('laporan', $pengaduan->laporan) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary">Simpan (placeholder)</button>
            </div>
        </form>
        <p class="text-muted small mt-2">Catatan: fungsi penyimpanan tidak diimplementasikan karena perubahan hanya diperbolehkan di routes & views.</p>
    </div>
</div>
@endsection
