@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600 mt-2">Selamat datang, {{ Auth::user()->name }}!</p>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Pengaduan -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100">Total Pengaduan</p>
                    <p class="text-4xl font-bold mt-2">{{ $total }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Pending -->
        <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-yellow-100">Pending</p>
                    <p class="text-4xl font-bold mt-2">{{ $pending }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 102 0V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Diproses -->
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100">Diproses</p>
                    <p class="text-4xl font-bold mt-2">{{ $diproses }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Selesai -->
        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-100">Selesai</p>
                    <p class="text-4xl font-bold mt-2">{{ $selesai }}</p>
                </div>
                <div class="w-12 h-12 bg-green-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Pengaduan -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Pengaduan Terbaru</h2>
                    <a href="{{ route('user.pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat Semua</a>
                </div>

                @if($recentPengaduan->count() > 0)
                    <div class="divide-y">
                        @foreach($recentPengaduan as $p)
                            <div class="p-6 hover:bg-gray-50 transition cursor-pointer group">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-blue-600">
                                        <a href="{{ route('user.pengaduan.show', $p->id) }}">{{ Str::limit($p->laporan, 40) }}</a>
                                    </h3>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                                        @if($p->status === 'pending') bg-yellow-100 text-yellow-800
                                        @elseif($p->status === 'dalam pengerjaan') bg-purple-100 text-purple-800
                                        @elseif($p->status === 'selesai') bg-green-100 text-green-800
                                        @endif
                                    ">
                                        {{ ucfirst($p->status) }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">{{ Str::limit($p->laporan, 80) }}</p>
                                <div class="flex justify-between items-center text-sm text-gray-500">
                                    <span>{{ $p->created_at->format('d M Y H:i') }}</span>
                                    <a href="{{ route('user.pengaduan.show', $p->id) }}" class="text-blue-600 hover:underline">Detail →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <p class="text-gray-600 font-semibold">Belum ada pengaduan</p>
                        <a href="{{ route('user.pengaduan.create') }}" class="text-blue-600 hover:underline mt-2 inline-block">Buat pengaduan sekarang →</a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div>
            <!-- Create Pengaduan -->
            <a href="{{ route('user.pengaduan.create') }}" class="block w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-4 px-6 rounded-lg text-center transition shadow-lg mb-4">
                <svg class="w-6 h-6 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                Buat Pengaduan
            </a>

            <!-- Statistics Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-4">
                <h3 class="font-bold text-gray-800 mb-4">Statistik</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total:</span>
                        <span class="font-bold text-gray-800">{{ $total }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pending:</span>
                        <span class="font-bold text-yellow-600">{{ $pending }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Diproses:</span>
                        <span class="font-bold text-purple-600">{{ $diproses }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Selesai:</span>
                        <span class="font-bold text-green-600">{{ $selesai }}</span>
                    </div>
                </div>
            </div>

            <!-- Help Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6">
                <h3 class="font-bold text-gray-800 mb-2">Butuh Bantuan?</h3>
                <p class="text-sm text-gray-700 mb-4">Jika ada yang tidak jelas, hubungi admin kami melalui chat atau email.</p>
                <button class="w-full bg-white text-blue-600 hover:bg-blue-50 font-semibold py-2 px-4 rounded-lg transition border border-blue-200">
                    Hubungi Admin
                </button>
            </div>
        </div>
    </div>
</div>
@endsection