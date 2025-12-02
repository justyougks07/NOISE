<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pengaduan Masyarakat')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3a0ca3;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --light-color: #f8f9fa;
        }
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,.1);
        }
        .user-sidebar {
            background-color: white;
            border-right: 1px solid #dee2e6;
            min-height: calc(100vh - 56px);
        }
        .admin-sidebar {
            background-color: #2c3e50;
            min-height: calc(100vh - 56px);
            color: white;
        }
        .nav-link {
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s;
        }
        .user-sidebar .nav-link {
            color: #495057;
        }
        .user-sidebar .nav-link:hover, .user-sidebar .nav-link.active {
            background-color: #e9ecef;
            color: var(--primary-color);
        }
        .admin-sidebar .nav-link {
            color: rgba(255,255,255,.8);
        }
        .admin-sidebar .nav-link:hover, .admin-sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 2px 15px rgba(0,0,0,.05);
            border: none;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: white;
            border-bottom: 1px solid #eee;
            font-weight: 600;
            border-radius: 12px 12px 0 0 !important;
        }
        .status-badge {
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85em;
            font-weight: 500;
        }
        .status-pending { background-color: #fff3cd; color: #856404; }
        .status-progress { background-color: #d1ecf1; color: #0c5460; }
        .status-selesai { background-color: #d4edda; color: #155724; }
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            border: none;
        }
        .btn-primary:hover {
            opacity: 0.9;
        }
        .chat-bubble {
            max-width: 75%;
            border-radius: 15px;
            padding: 12px 16px;
            margin-bottom: 12px;
        }
        .chat-left {
            background-color: #e9ecef;
            border-bottom-left-radius: 5px;
        }
        .chat-right {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            border-bottom-right-radius: 5px;
        }
        .unread-badge {
            background-color: var(--warning-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-shield-check me-2"></i>
                <strong>Sistem Pengaduan</strong>
            </a>
            <div class="d-flex align-items-center">
                @auth
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="rounded-circle me-2" width="32" height="32">
                        @else
                            <div class="avatar me-2" style="background-color: {{ Auth::user()->role == 'admin' ? '#dc3545' : '#4361ee' }};">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                        @endif
                        <div class="d-none d-md-block">
                            <div>{{ Auth::user()->name }}</div>
                            <small class="opacity-75">{{ Auth::user()->role == 'admin' ? 'Administrator' : 'Pengguna' }}</small>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                    
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            @auth
            <!-- Sidebar berdasarkan role -->
            @if(Auth::user()->role == 'admin')
                <!-- Admin Sidebar -->
                <div class="col-md-3 col-lg-2 p-0 admin-sidebar">
                    <div class="p-3">
                        <div class="mb-4 px-2">
                            <h6 class="text-muted mb-3">MENU ADMIN</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                                        <i class="bi bi-speedometer2 me-2"></i>
                                        Dashboard
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/pengaduan*') ? 'active' : '' }}" href="{{ route('admin.pengaduan.index') }}">
                                        <i class="bi bi-megaphone me-2"></i>
                                        Pengaduan
                                        @php
                                            $pendingCount = App\Models\Pengaduan::where('status', 'pending')->count();
                                        @endphp
                                        @if($pendingCount > 0)
                                            <span class="unread-badge float-end">{{ $pendingCount }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/chat*') ? 'active' : '' }}" href="{{ route('admin.chat.index') }}">
                                        <i class="bi bi-chat-dots me-2"></i>
                                        Chat
                                        @php
                                            // 'is_read' column doesn't exist on the Chat table in this app
                                            // so we fall back to counting chats on pengaduan that belong
                                            // to others (useful indicator for admin). This prevents
                                            // SQL errors if the column is missing.
                                            $unreadChats = App\Models\Chat::whereHas('pengaduan', function($q) {
                                                $q->where('user_id', '!=', Auth::id());
                                            })->count();
                                        @endphp
                                        @if($unreadChats > 0)
                                            <span class="unread-badge float-end">{{ $unreadChats }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/users*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                                        <i class="bi bi-people me-2"></i>
                                        Pengguna
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('admin/reports*') ? 'active' : '' }}" href="{{ route('admin.reports.index') }}">
                                        <i class="bi bi-bar-chart me-2"></i>
                                        Laporan
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="px-2 mt-4">
                            <h6 class="text-muted mb-3">STATISTIK</h6>
                            <div class="px-2">
                                <small class="d-block text-white-50 mb-1">
                                    <i class="bi bi-clock me-1"></i> Pending: {{ $pendingCount ?? 0 }}
                                </small>
                                <small class="d-block text-white-50 mb-1">
                                    <i class="bi bi-gear me-1"></i> Diproses: {{ App\Models\Pengaduan::where('status', 'dalam pengerjaan')->count() }}
                                </small>
                                <small class="d-block text-white-50">
                                    <i class="bi bi-check-circle me-1"></i> Selesai: {{ App\Models\Pengaduan::where('status', 'selesai')->count() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <!-- User Sidebar -->
                <div class="col-md-3 col-lg-2 p-0 user-sidebar">
                    <div class="p-3">
                        <div class="mb-4 px-2">
                            <h6 class="text-muted mb-3">MENU PENGGUNA</h6>
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('user/dashboard') ? 'active' : '' }}" href="{{ route('user.dashboard') }}">
                                        <i class="bi bi-house me-2"></i>
                                        Beranda
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('user/pengaduan*') ? 'active' : '' }}" href="{{ route('user.pengaduan.index') }}">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Buat Pengaduan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ Request::is('user/riwayat*') ? 'active' : '' }}" href="{{ route('user.riwayat.index') }}">
                                        <i class="bi bi-clock-history me-2"></i>
                                        Riwayat Pengaduan
                                    </a>
                                </li>
                                <li class="nav-item">
                                
                               
                                    </a>
                                </li>
                            </ul>
                        </div>
                        
                        <div class="px-2 mt-4">
                            <h6 class="text-muted mb-3">PENGADUAN SAYA</h6>
                            <div class="px-2">
                                @php
                                    $myPengaduan = App\Models\Pengaduan::where('user_id', Auth::id());
                                @endphp
                                <small class="d-block text-muted mb-1">
                                    <i class="bi bi-clock me-1"></i> Pending: {{ $myPengaduan->where('status', 'pending')->count() }}
                                </small>
                                <small class="d-block text-muted mb-1">
                                    <i class="bi bi-gear me-1"></i> Diproses: {{ $myPengaduan->where('status', 'dalam pengerjaan')->count() }}
                                </small>
                                <small class="d-block text-muted">
                                    <i class="bi bi-check-circle me-1"></i> Selesai: {{ $myPengaduan->where('status', 'selesai')->count() }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endauth

            <!-- Main Content -->
            <main class="@auth col-md-9 ms-sm-auto col-lg-10 @else col-12 @endauth px-4 py-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle me-2"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
    @stack('scripts')
    <script>
        $(document).ready(function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
</body>
</html>