<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NOISE - Sistem Informasi Pengaduan Masyarakat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    @if(Auth::check())
        <nav class="bg-white shadow-md sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-16">
                    <!-- Logo -->
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">N</span>
                        </div>
                        <span class="text-xl font-bold text-gray-800">NOISE</span>
                    </div>

                    <!-- Menu Items -->
                    <div class="hidden md:flex items-center space-x-8">
                        @if(Auth::user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                            <a href="{{ route('admin.pengaduan.index') }}" class="text-gray-700 hover:text-blue-600 transition">Pengaduan</a>
                            <a href="{{ route('admin.users.index') }}" class="text-gray-700 hover:text-blue-600 transition">Pengguna</a>
                            <a href="{{ route('admin.reports.index') }}" class="text-gray-700 hover:text-blue-600 transition">Laporan</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="text-gray-700 hover:text-blue-600 transition">Dashboard</a>
                            <a href="{{ route('user.pengaduan.index') }}" class="text-gray-700 hover:text-blue-600 transition">Pengaduan</a>
                            <a href="{{ route('user.riwayat.index') }}" class="text-gray-700 hover:text-blue-600 transition">Riwayat</a>
                        @endif
                    </div>

                    <!-- User Menu -->
                    <div class="flex items-center space-x-4">
                        <div class="relative group">
                            <button class="flex items-center space-x-2 px-4 py-2 rounded-lg hover:bg-gray-100 transition">
                                <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                </div>
                                <span class="text-gray-700 font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <div class="absolute right-0 w-48 bg-white rounded-lg shadow-lg py-2 hidden group-hover:block">
                                <div class="px-4 py-2 text-sm text-gray-700 border-b">
                                    <p class="font-semibold">{{ Auth::user()->name }}</p>
                                    <p class="text-gray-500">{{ Auth::user()->email }}</p>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 transition">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    @endif

    <!-- Main Content -->
    <main class="min-h-screen">
        <!-- Flash Messages -->
        @if($errors->any())
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <p class="text-red-700 font-semibold">Error:</p>
                    <ul class="text-red-600 mt-2 space-y-1">
                        @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if(session('success'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="bg-green-50 border-l-4 border-green-500 p-4 rounded-lg">
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
                <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-lg">
                    <p class="text-red-700">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t border-gray-200 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold">N</span>
                        </div>
                        <span class="font-bold text-gray-800">NOISE</span>
                    </div>
                    <p class="text-gray-600">Sistem Informasi Pengaduan Masyarakat</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-4">Quick Links</h3>
                    <ul class="space-y-2 text-gray-600">
                        <li><a href="#" class="hover:text-blue-600 transition">Tentang</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-blue-600 transition">Kontak</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800 mb-4">Kontak</h3>
                    <p class="text-gray-600">Email: info@noise.com</p>
                    <p class="text-gray-600">Phone: +62 XXX XXXX XXXX</p>
                </div>
            </div>
            <hr class="my-8">
            <div class="text-center text-gray-600">
                <p>&copy; 2025 NOISE. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>
