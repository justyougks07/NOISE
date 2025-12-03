@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-4xl font-bold text-gray-800">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Kelola dan monitor semua pengaduan dari masyarakat</p>
        </div>
        <button onclick="window.print()" class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-2 px-4 rounded-lg transition flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4H7a2 2 0 01-2-2v-4a2 2 0 012-2h10a2 2 0 012 2v4a2 2 0 01-2 2zm0 0h6"></path>
            </svg>
            Cetak Laporan
        </button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Total Pengaduan -->
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-blue-100">Total Pengaduan</p>
                    <p class="text-4xl font-bold mt-2">{{ $totalPengaduan }}</p>
                    <p class="text-blue-100 text-sm mt-2">Semua pengaduan</p>
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
                    <p class="text-yellow-100 text-sm mt-2">Menunggu proses</p>
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
                    <p class="text-purple-100 text-sm mt-2">Sedang ditangani</p>
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
                    <p class="text-green-100 text-sm mt-2">Penanganan selesai</p>
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
        <!-- Pengaduan Terbaru -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">Pengaduan Terbaru</h2>
                    <a href="{{ route('admin.pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold text-sm">Lihat Semua</a>
                </div>

                <div class="divide-y">
                    @forelse(\App\Models\Pengaduan::latest()->take(5)->get() as $p)
                        <div class="p-6 hover:bg-gray-50 transition cursor-pointer">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-800">Pengaduan #{{ $p->id }}</h3>
                                    <p class="text-gray-600 text-sm">dari <strong>{{ $p->user->name }}</strong></p>
                                </div>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    @if($p->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($p->status === 'dalam pengerjaan') bg-purple-100 text-purple-800
                                    @elseif($p->status === 'selesai') bg-green-100 text-green-800
                                    @endif
                                ">
                                    {{ ucfirst($p->status) }}
                                </span>
                            </div>
                            <p class="text-gray-600 text-sm mb-3">{{ Str::limit($p->laporan, 100) }}</p>
                            <div class="flex justify-between items-center text-sm text-gray-500">
                                <span>{{ $p->created_at->format('d M Y, H:i') }}</span>
                                <a href="{{ route('admin.pengaduan.show', $p->id) }}" class="text-blue-600 hover:underline">Tinjau →</a>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-500">
                            Belum ada pengaduan
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div>
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Status Pengaduan</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pending</span>
                        <div class="flex-1 mx-3 bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($pending/$totalPengaduan)*100 : 0 }}%"></div>
                        </div>
                        <span class="font-bold text-gray-800">{{ $pending }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Diproses</span>
                        <div class="flex-1 mx-3 bg-gray-200 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($diproses/$totalPengaduan)*100 : 0 }}%"></div>
                        </div>
                        <span class="font-bold text-gray-800">{{ $diproses }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Selesai</span>
                        <div class="flex-1 mx-3 bg-gray-200 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: {{ $totalPengaduan > 0 ? ($selesai/$totalPengaduan)*100 : 0 }}%"></div>
                        </div>
                        <span class="font-bold text-gray-800">{{ $selesai }}</span>
                    </div>
                </div>
            </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection