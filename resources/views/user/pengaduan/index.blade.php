@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Daftar Pengaduan</h1>
            <p class="text-gray-600 mt-2">Kelola semua pengaduan Anda di sini</p>
        </div>
        <a href="{{ route('user.pengaduan.create') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition shadow-lg flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Buat Pengaduan Baru
        </a>
    </div>

    <!-- Filter Tabs -->
    <div class="mb-6 border-b border-gray-200">
        <div class="flex space-x-4 overflow-x-auto">
            <a href="{{ route('user.pengaduan.index') }}" class="px-4 py-2 font-semibold text-blue-600 border-b-2 border-blue-600 whitespace-nowrap">
                Semua ({{ $pengaduan->count() }})
            </a>
            <a href="{{ route('user.pengaduan.index', ['status' => 'pending']) }}" class="px-4 py-2 font-semibold text-gray-600 hover:text-blue-600 border-b-2 border-transparent whitespace-nowrap">
                Pending ({{ $pengaduan->where('status', 'pending')->count() }})
            </a>
            <a href="{{ route('user.pengaduan.index', ['status' => 'dalam pengerjaan']) }}" class="px-4 py-2 font-semibold text-gray-600 hover:text-blue-600 border-b-2 border-transparent whitespace-nowrap {{ request('status') === 'dalam pengerjaan' ? 'active-class' : '' }}">
                Diproses ({{ $pengaduan->where('status', 'dalam pengerjaan')->count() }})
            </a>
            <a href="{{ route('user.pengaduan.index', ['status' => 'selesai']) }}" class="px-4 py-2 font-semibold text-gray-600 hover:text-blue-600 border-b-2 border-transparent whitespace-nowrap {{ request('status') === 'selesai' ? 'active-class' : '' }}">
                Selesai ({{ $pengaduan->where('status', 'selesai')->count() }})
            </a>
        </div>
    </div>

    @if($pengaduan->count() > 0)
        <div class="grid grid-cols-1 gap-4">
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
                                <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ Str::limit($p->laporan, 60) }}</h3>
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($p->laporan, 150) }}</p>
                                
                                @if($p->foto)
                                    <div class="flex items-center text-sm text-gray-500 mb-3">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"></path>
                                        </svg>
                                        Foto tersedia
                                    </div>
                                @endif

                                <div class="flex items-center gap-4 text-sm text-gray-500">
                                    <span>{{ $p->created_at->format('d M Y, H:i') }}</span>
                                    @if($p->chats->count() > 0)
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M2 5a2 2 0 012-2h12a2 2 0 012 2v10a2 2 0 01-2 2H4a2 2 0 01-2-2V5z"></path>
                                                <path d="M6 11a1 1 0 11-2 0 1 1 0 012 0zM12 11a1 1 0 11-2 0 1 1 0 012 0zM16 11a1 1 0 11-2 0 1 1 0 012 0z"></path>
                                            </svg>
                                            {{ $p->chats->count() }} pesan
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="flex gap-2">
                                <a href="{{ route('user.pengaduan.show', $p->id) }}" class="bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold py-2 px-4 rounded-lg transition">
                                    Lihat Detail
                                </a>
                                @if($p->status === 'pending')
                                    <a href="{{ route('user.pengaduan.edit', $p->id) }}" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-2 px-4 rounded-lg transition">
                                        Edit
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        @if($pengaduan->hasPages())
            <div class="mt-8 flex justify-center">
                {{ $pengaduan->links() }}
            </div>
        @endif
    @else
        <div class="bg-white rounded-lg shadow-lg p-12 text-center">
            <svg class="w-20 h-20 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Pengaduan</h2>
            <p class="text-gray-600 mb-6">Anda belum membuat pengaduan. Mulai sekarang untuk menyampaikan keluhan atau laporan Anda.</p>
            <a href="{{ route('user.pengaduan.create') }}" class="inline-block bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-8 rounded-lg transition shadow-lg">
                <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Pengaduan Pertama Anda
            </a>
        </div>
    @endif
</div>
@endsection
