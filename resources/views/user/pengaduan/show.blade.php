@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('user.pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali ke Daftar
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-8 py-6 text-white">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-bold">Pengaduan #{{ $pengaduan->id }}</h1>
                            <p class="text-blue-100 mt-1">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                        </div>
                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                            @if($pengaduan->status === 'pending') bg-yellow-200 text-yellow-800
                            @elseif($pengaduan->status === 'dalam pengerjaan') bg-purple-200 text-purple-800
                            @elseif($pengaduan->status === 'selesai') bg-green-200 text-green-800
                            @endif
                        ">
                            {{ ucfirst($pengaduan->status) }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-8">
                    <!-- Laporan -->
                    <section class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Laporan Pengaduan
                        </h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $pengaduan->laporan }}</p>
                    </section>

                    <!-- Foto -->
                    @if($pengaduan->foto)
                        <section class="mb-8">
                            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Foto Bukti
                            </h2>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <img src="{{ asset('storage/' . $pengaduan->foto) }}" alt="Foto Pengaduan" class="max-w-full h-auto rounded-lg">
                            </div>
                        </section>
                    @endif

                    <!-- Timeline -->
                    <section>
                        <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Status Pengaduan
                        </h2>
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full bg-blue-600 text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Pengaduan Dibuat</p>
                                    <p class="text-gray-600">{{ $pengaduan->created_at->format('d F Y, H:i') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full
                                    @if($pengaduan->status !== 'pending') bg-blue-600 text-white
                                    @else bg-gray-300 text-gray-600
                                    @endif
                                ">
                                    @if($pengaduan->status !== 'pending')
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        ●
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Dalam Proses</p>
                                    <p class="text-gray-600">Menunggu review dari admin</p>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <div class="flex items-center justify-center h-10 w-10 rounded-full
                                    @if($pengaduan->status === 'selesai') bg-blue-600 text-white
                                    @else bg-gray-300 text-gray-600
                                    @endif
                                ">
                                    @if($pengaduan->status === 'selesai')
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @else
                                        ●
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <p class="font-semibold text-gray-800">Selesai</p>
                                    <p class="text-gray-600">Pengaduan telah ditangani</p>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Info Card -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                <h3 class="font-bold text-gray-800 mb-4">Informasi Pengaduan</h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm text-gray-600">Status Saat Ini</p>
                        <p class="font-semibold text-gray-800 capitalize">{{ $pengaduan->status }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Dibuat Oleh</p>
                        <p class="font-semibold text-gray-800">{{ $pengaduan->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Waktu Pembuatan</p>
                        <p class="font-semibold text-gray-800">{{ $pengaduan->created_at->format('d M Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jumlah Chat</p>
                        <p class="font-semibold text-gray-800">{{ $pengaduan->chats->count() }} pesan</p>
                    </div>
                </div>
            </div>

            <!-- Action Card -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-200 p-6">
                <h3 class="font-bold text-gray-800 mb-4">Opsi</h3>
                <div class="space-y-3">
                    <a href="#chat-section" class="block w-full bg-white text-blue-600 hover:bg-blue-50 font-semibold py-2 px-4 rounded-lg transition border border-blue-200 text-center">
                        Chat dengan Admin
                    </a>
                    @if($pengaduan->status === 'pending')
                        <a href="{{ route('user.pengaduan.edit', $pengaduan->id) }}" class="block w-full bg-white text-blue-600 hover:bg-blue-50 font-semibold py-2 px-4 rounded-lg transition border border-blue-200 text-center">
                            Edit Pengaduan
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Chat Section -->
    <div id="chat-section" class="mt-12 bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Chat dengan Admin
            </h2>
        </div>

        <div class="p-8">
            @if($pengaduan->chats->count() > 0)
                <div class="space-y-4 mb-8 max-h-96 overflow-y-auto">
                    @foreach($pengaduan->chats as $chat)
                        <div class="flex {{ $chat->user_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-xs lg:max-w-md
                                @if($chat->user_id === Auth::id()) bg-blue-600 text-white
                                @else bg-gray-100 text-gray-800
                                @endif
                            rounded-lg p-4">
                                <p class="font-semibold text-sm mb-1">{{ $chat->user->name }}</p>
                                <p>{{ $chat->pesan }}</p>
                                <p class="text-xs mt-2 {{ $chat->user_id === Auth::id() ? 'text-blue-100' : 'text-gray-500' }}">
                                    {{ $chat->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-600 mb-4">Belum ada pesan chat</p>
                </div>
            @endif

            <!-- Chat Form -->
            <form action="{{ route('chat.send') }}" method="POST" class="flex gap-2">
                @csrf
                <input type="hidden" name="pengaduan_id" value="{{ $pengaduan->id }}">
                <textarea 
                    name="pesan" 
                    rows="3"
                    placeholder="Tulis pesan Anda..."
                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition resize-none @error('pesan') border-red-500 @enderror"
                    required
                ></textarea>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition self-end">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                </button>
            </form>
            @error('pesan')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
@endsection
