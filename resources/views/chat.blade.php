@extends('layout')

@section('title', 'Chat - Sistem Pengaduan')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h3">
        <i class="bi bi-chat-dots me-2"></i>
        Chat
    </h1>
    <div class="btn-group">
        <button class="btn btn-outline-primary">
            <i class="bi bi-people me-1"></i>
            Online: 3
        </button>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Daftar Percakapan</h5>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action active">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    BS
                                </div>
                                <div>
                                    <h6 class="mb-0">Budi Santoso</h6>
                                    <small class="text-white-80">2 pesan baru</small>
                                </div>
                            </div>
                            <small>10:30</small>
                        </div>
                        <p class="mb-0 mt-2">Kapan perbaikan jalan bisa dimulai?</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-success text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    SR
                                </div>
                                <div>
                                    <h6 class="mb-0">Siti Rahayu</h6>
                                    <small class="text-muted">Online</small>
                                </div>
                            </div>
                            <small>09:45</small>
                        </div>
                        <p class="mb-0 mt-2">Lampu sudah diperbaiki</p>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="d-flex w-100 justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-sm bg-warning text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    AW
                                </div>
                                <div>
                                    <h6 class="mb-0">Agus Wijaya</h6>
                                    <small class="text-muted">Selesai</small>
                                </div>
                            </div>
                            <small>Kemarin</small>
                        </div>
                        <p class="mb-0 mt-2">Sampah sudah dibersihkan</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2" style="width: 36px; height: 36px;">
                        BS
                    </div>
                    <div>
                        <h5 class="mb-0">Budi Santoso</h5>
                        <small class="text-muted">Pengaduan #101 - Jalan Berlubang</small>
                    </div>
                </div>
                <div>
                    <span class="status-badge status-pending">pending</span>
                </div>
            </div>
            <div class="card-body chat-messages" style="height: 400px; overflow-y: auto; background-color: #f8f9fa;">
                <!-- Pesan dari user -->
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <div class="chat-bubble chat-left">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>Budi Santoso</strong>
                                <small class="text-muted">10:30</small>
                            </div>
                            <p class="mb-0">Halo, saya ingin melaporkan jalan berlubang di depan sekolah SDN 01. Sudah berapa hari ini dan sangat berbahaya untuk anak-anak.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pesan dari admin -->
                <div class="mb-3">
                    <div class="d-flex justify-content-end">
                        <div class="chat-bubble chat-right">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>Admin</strong>
                                <small class="text-white-50">10:35</small>
                            </div>
                            <p class="mb-0">Terima kasih laporannya Pak Budi. Tim kami akan mengecek dan memperbaiki dalam 2-3 hari kerja.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Pesan dari user -->
                <div class="mb-3">
                    <div class="d-flex justify-content-start">
                        <div class="chat-bubble chat-left">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>Budi Santoso</strong>
                                <small class="text-muted">10:40</small>
                            </div>
                            <p class="mb-0">Baik, terima kasih. Kapan perbaikan bisa dimulai? Lubangnya cukup besar.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <form action="{{ route('chat.send') }}" method="POST">
                    @csrf
                    <div class="input-group">
                        @if(isset($pengaduan))
                            <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                        @endif
                        <input type="text" name="pesan" class="form-control" placeholder="Ketik pesan..." required>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Kirim
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Auto scroll to bottom
        var chatContainer = $('.chat-messages');
        chatContainer.scrollTop(chatContainer[0].scrollHeight);
    });
</script>