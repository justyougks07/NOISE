@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('user.pengaduan.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center mb-4">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
            Kembali
        </a>
        <h1 class="text-4xl font-bold text-gray-800">Buat Pengaduan Baru</h1>
        <p class="text-gray-600 mt-2">Sampaikan masalah Anda dengan jelas dan lengkap</p>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-8">
        <form action="{{ route('user.pengaduan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <!-- Laporan -->
            <div>
                <label for="laporan" class="block text-sm font-semibold text-gray-800 mb-3">
                    Laporan Pengaduan <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="laporan" 
                    name="laporan" 
                    rows="6"
                    placeholder="Jelaskan masalah Anda dengan detail dan jelas. Sertakan lokasi, waktu, dan kronologi kejadian..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 transition resize-none @error('laporan') border-red-500 @enderror"
                    required
                >{{ old('laporan') }}</textarea>
                @error('laporan')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
                <p class="text-gray-500 text-sm mt-2">Minimal 20 karakter, maksimal 5000 karakter</p>
            </div>

            <!-- Foto -->
            <div>
                <label for="foto" class="block text-sm font-semibold text-gray-800 mb-3">
                    Unggah Foto <span class="text-gray-500 text-sm">(Opsional)</span>
                </label>
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-blue-500 transition" onclick="document.getElementById('foto').click()">
                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <p class="text-gray-700 font-semibold">Klik untuk unggah foto</p>
                    <p class="text-gray-500 text-sm">atau drag dan drop di sini</p>
                    <p class="text-gray-500 text-sm mt-2">Format: JPG, PNG (Maks: 2MB)</p>
                </div>
                <input 
                    type="file" 
                    id="foto" 
                    name="foto" 
                    accept="image/jpeg,image/png" 
                    class="hidden"
                    onchange="updateFileName(this)"
                >
                <p id="fileName" class="text-sm text-gray-600 mt-2"></p>
                @error('foto')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Info Tips -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-900 mb-2">💡 Tips untuk Pengaduan yang Baik:</h3>
                <ul class="text-sm text-blue-800 space-y-1">
                    <li>✓ Jelaskan masalah dengan kronologi yang jelas</li>
                    <li>✓ Sertakan lokasi spesifik (alamat lengkap)</li>
                    <li>✓ Lampirkan foto sebagai bukti pendukung</li>
                    <li>✓ Tulis data yang akurat dan dapat diverifikasi</li>
                </ul>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4">
                <a href="{{ route('user.pengaduan.index') }}" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition text-center">
                    Batal
                </a>
                <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                    </svg>
                    Kirim Pengaduan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function updateFileName(input) {
    const fileName = document.getElementById('fileName');
    if (input.files && input.files[0]) {
        fileName.textContent = '✓ File dipilih: ' + input.files[0].name;
        fileName.classList.remove('text-red-500');
        fileName.classList.add('text-green-600');
    }
}
</script>
@endsection