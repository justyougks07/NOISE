@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Laporan</h1>
            <p class="text-gray-600 mt-2">Analisis dan laporan pengaduan masyarakat</p>
        </div>
        <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4H7a2 2 0 01-2-2v-4a2 2 0 012-2h10a2 2 0 012 2v4a2 2 0 01-2 2zm0 0h6"></path>
            </svg>
            Cetak Laporan
        </button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100">Total Pengaduan</p>
                    <p class="text-4xl font-bold mt-2">{{ \App\Models\Pengaduan::count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-green-100">Pengaduan Selesai</p>
                    <p class="text-4xl font-bold mt-2">{{ \App\Models\Pengaduan::where('status', 'selesai')->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-purple-100">Tingkat Penyelesaian</p>
                    <p class="text-4xl font-bold mt-2">
                        {{ \App\Models\Pengaduan::count() > 0 ? round((\App\Models\Pengaduan::where('status', 'selesai')->count() / \App\Models\Pengaduan::count()) * 100) : 0 }}%
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-400 bg-opacity-30 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2 1 1 0 010 2zM9 11a1 1 0 11-2 0 1 1 0 012 0zm6 0a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Status Distribution -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Distribusi Status Pengaduan</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700 font-semibold">Pending</span>
                        <span class="text-gray-600">{{ \App\Models\Pengaduan::where('status', 'pending')->count() }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ \App\Models\Pengaduan::count() > 0 ? (\App\Models\Pengaduan::where('status', 'pending')->count() / \App\Models\Pengaduan::count()) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700 font-semibold">Dalam Pengerjaan</span>
                        <span class="text-gray-600">{{ \App\Models\Pengaduan::where('status', 'dalam pengerjaan')->count() }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-purple-500 h-2 rounded-full" style="width: {{ \App\Models\Pengaduan::count() > 0 ? (\App\Models\Pengaduan::where('status', 'dalam pengerjaan')->count() / \App\Models\Pengaduan::count()) * 100 : 0 }}%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700 font-semibold">Selesai</span>
                        <span class="text-gray-600">{{ \App\Models\Pengaduan::where('status', 'selesai')->count() }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-green-500 h-2 rounded-full" style="width: {{ \App\Models\Pengaduan::count() > 0 ? (\App\Models\Pengaduan::where('status', 'selesai')->count() / \App\Models\Pengaduan::count()) * 100 : 0 }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6">Aktivitas Terbaru</h3>
            <div class="space-y-4">
                @forelse(\App\Models\Pengaduan::latest()->take(5)->get() as $pengaduan)
                    <div class="flex justify-between items-start pb-4 border-b border-gray-200 last:border-0">
                        <div>
                            <p class="font-semibold text-gray-800">Pengaduan #{{ $pengaduan->id }}</p>
                            <p class="text-sm text-gray-600">{{ $pengaduan->user->name }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $pengaduan->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($pengaduan->status === 'pending') bg-yellow-100 text-yellow-800
                            @elseif($pengaduan->status === 'dalam pengerjaan') bg-purple-100 text-purple-800
                            @elseif($pengaduan->status === 'selesai') bg-green-100 text-green-800
                            @endif
                        ">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-gray-600">Belum ada aktivitas</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
