<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ChatController;
use Illuminate\Support\Facades\Auth;

// ========================
// 1. PUBLIC ROUTES (GUEST)
// ========================
Route::middleware('guest')->group(function () {
    
    // Login
    Route::get('/login', function() {
        return view('login');
    })->name('login');
    
    Route::post('/login', function(\Illuminate\Http\Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // If the user attempted to access a protected page before login,
            // redirect them to the intended URL. Otherwise fallback to the
            // user's dashboard based on their role.
            $fallback = Auth::user()->role == 'admin' ? route('admin.dashboard') : route('user.dashboard');
            return redirect()->intended($fallback);
        }
        
        return back()->with('error', 'Login gagal!');
    });
    
    // Register (jika dibutuhkan)
    Route::get('/register', function() {
        return view('register');
    })->name('register');
    
    Route::post('/register', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        
        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);
        
        Auth::login($user);

        // After registration, prefer intended redirect if available, otherwise
        // send the user to their dashboard.
        return redirect()->intended(route('user.dashboard'));
    });

    // Forgot Password
    Route::get('/forgot-password', function() {
        return view('forgot-password');
    })->name('password.request');

    Route::post('/forgot-password', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = \App\Models\User::where('email', $request->email)->first();
        
        // Generate reset token dan simpan ke database
        $token = \Illuminate\Support\Str::random(60);
        
        // Simpan token ke DB (menggunakan password reset tokens table)
        \DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $user->email],
            [
                'token' => Hash::make($token),
                'created_at' => now(),
            ]
        );

        // Return success message (dalam real app, kirim email dengan link reset)
        return back()->with('success', 'Instruksi reset password telah dikirim ke email Anda (cek spam folder)');
    })->name('password.email');

    // Reset Password Form
    Route::get('/reset-password/{token}', function($token) {
        return view('reset-password', ['token' => $token]);
    })->name('password.reset');

    Route::post('/reset-password', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $resetToken = \DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$resetToken || !Hash::check($request->token, $resetToken->token)) {
            return back()->with('error', 'Token tidak valid atau sudah kadaluarsa');
        }

        // Update password user
        $user = \App\Models\User::where('email', $request->email)->first();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Hapus token
        \DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect('/login')->with('success', 'Password berhasil direset. Silakan login dengan password baru Anda.');
    })->name('password.update');
});

// ========================
// 2. PROTECTED ROUTES (AUTH)
// ========================
Route::middleware('auth')->group(function() {
    
    // Logout
    Route::post('/logout', function(\Illuminate\Http\Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');
    
    // Home Redirect
    Route::get('/', function() {
        if (Auth::user()->role == 'admin') {
            return redirect('/admin/dashboard');
        }
        return redirect('/user/dashboard');
    });
    
    // ========== USER ROUTES ==========
    Route::prefix('user')->name('user.')->group(function() {
        
        // User Dashboard
        Route::get('/dashboard', function() {
            $user = Auth::user();
            if ($user->role !== 'user') abort(403);
            
                $pengaduan = \App\Models\Pengaduan::where('user_id', $user->id)->latest()->get();
                $total = $pengaduan->count();
                $pending = $pengaduan->where('status', 'pending')->count();
                $diproses = $pengaduan->where('status', 'dalam pengerjaan')->count();
                $selesai = $pengaduan->where('status', 'selesai')->count();

                // small dashboard widgets
                $recentPengaduan = $pengaduan->take(5);
                $recentChats = \App\Models\Chat::where('user_id', $user->id)->latest()->take(5)->get();

                return view('user.dashboard', compact('pengaduan', 'total', 'pending', 'diproses', 'selesai', 'recentPengaduan', 'recentChats'));
        })->name('dashboard');
        
        Route::get('/riwayat', function() {
        $user = Auth::user();
        if ($user->role !== 'user') abort(403);
        
        $pengaduan = \App\Models\Pengaduan::where('user_id', $user->id)
            ->latest()
            ->paginate(10);
            
        return view('user.riwayat.index', compact('pengaduan'));
    })->name('riwayat.index');

        
        // User Pengaduan
        Route::get('/pengaduan', function() {
            $user = Auth::user();
            if ($user->role !== 'user') abort(403);
            
            $pengaduan = \App\Models\Pengaduan::where('user_id', $user->id)->latest()->paginate(10);
            return view('user.pengaduan.index', compact('pengaduan'));
        })->name('pengaduan.index');
        
        Route::get('/pengaduan/create', function() {
            $user = Auth::user();
            if ($user->role !== 'user') abort(403);
            return view('user.pengaduan.create');
        })->name('pengaduan.create');
        
        Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

        // Show a single pengaduan (web page)
        Route::get('/pengaduan/{id}', function(\Illuminate\Http\Request $request, $id) {
            $user = $request->user();
            if ($user->role !== 'user') abort(403);

            $pengaduan = \App\Models\Pengaduan::with('chats.user')->findOrFail($id);
            if ($pengaduan->user_id !== $user->id) abort(403);

            return view('user.pengaduan.show', compact('pengaduan'));
        })->name('pengaduan.show');

        // Edit pengaduan form
        Route::get('/pengaduan/{id}/edit', function(\Illuminate\Http\Request $request, $id) {
            $user = $request->user();
            if ($user->role !== 'user') abort(403);

            $pengaduan = \App\Models\Pengaduan::findOrFail($id);
            if ($pengaduan->user_id !== $user->id) abort(403);

            return view('user.pengaduan.edit', compact('pengaduan'));
        })->name('pengaduan.edit');

        // User chat index & show
        Route::get('/chat', function() {
            return view('chat');
        })->name('chat.index');

        Route::get('/chat/{id}', function($id) {
            // show chat for a specific pengaduan id
            $pengaduan = \App\Models\Pengaduan::findOrFail($id);
            return view('chat', compact('pengaduan'));
        })->name('chat.show');

        // Small endpoint to return unread chat count for the current user
        Route::get('/chat/unread-count', function(\Illuminate\Http\Request $request) {
            if (!$request->user()) return response()->json(['count' => 0]);
            // count chats related to user's pengaduan that may need attention
            $count = \App\Models\Chat::whereHas('pengaduan', function($q) use ($request) {
                $q->where('user_id', $request->user()->id);
            })->count();
            return response()->json(['count' => $count]);
        })->name('chat.unread-count');
        
    });

    // POST route to send chat (accept pengaduan_id in body)
    Route::post('/chat/send', function(\Illuminate\Http\Request $request) {
        $request->validate([
            'pesan' => 'required',
            'pengaduan_id' => 'required|exists:pengaduan,id'
        ]);

        $pengaduan = \App\Models\Pengaduan::findOrFail($request->pengaduan_id);
        if ($request->user()->role === 'user' && $pengaduan->user_id !== $request->user()->id) {
            abort(403);
        }

        $chat = \App\Models\Chat::create([
            'pengaduan_id' => $pengaduan->id,
            'user_id' => $request->user()->id,
            'pesan' => $request->pesan,
        ]);

        // if request expects json return json
        if ($request->wantsJson()) return response()->json($chat);

        return redirect()->back()->with('success', 'Pesan terkirim');
    })->name('chat.send');

    // Tokens create endpoint (placeholder) - doesn't create a real token, just returns success for UI flows.
    Route::post('/tokens/create', function(\Illuminate\Http\Request $request) {
        $request->validate([ 'name' => 'required|string' ]);
        // To keep scope limited to routes+views only, we won't create real tokens here.
        return redirect()->back()->with('success', 'Token dibuat (placeholder)');
    })->name('tokens.create');
    
    // ========== ADMIN ROUTES ==========
    Route::prefix('admin')->name('admin.')->group(function() {
        
        // Admin Dashboard
        Route::get('/dashboard', function() {
            $user = Auth::user();
            if ($user->role !== 'admin') abort(403);
            
            $totalPengaduan = \App\Models\Pengaduan::count();
            $pending = \App\Models\Pengaduan::where('status', 'pending')->count();
            $diproses = \App\Models\Pengaduan::where('status', 'dalam pengerjaan')->count();
            $selesai = \App\Models\Pengaduan::where('status', 'selesai')->count();

        return view('admin.dashboard', compact('totalPengaduan', 'pending', 'diproses', 'selesai'));
        })->name('dashboard');
        
        // Admin Pengaduan
        Route::get('/pengaduan', function() {
            $user = Auth::user();
            if ($user->role !== 'admin') abort(403);
            
            $pengaduan = \App\Models\Pengaduan::with('user')->latest()->get();
            return view('admin.pengaduan.index', compact('pengaduan'));
        })->name('pengaduan.index');

        Route::put('/pengaduan/{id}/status', [PengaduanController::class, 'updateStatus'])->name('pengaduan.updateStatus');

        // Admin Pengaduan show
        Route::get('/pengaduan/{id}', function(\Illuminate\Http\Request $request, $id) {
            $user = $request->user();
            if ($user->role !== 'admin') abort(403);
            $pengaduan = \App\Models\Pengaduan::with('user', 'chats.user')->findOrFail($id);
            return view('admin.pengaduan.show', compact('pengaduan'));
        })->name('pengaduan.show');

        // Admin chat index
        Route::get('/chat', function() {
            return view('chat');
        })->name('chat.index');

        // Admin users & reports (simple placeholders)
        Route::get('/users', function() {
            return view('admin.users.index');
        })->name('users.index');

        Route::get('/reports', function() {
            return view('admin.reports.index');
        })->name('reports.index');
        
        Route::put('/pengaduan/{id}/status',
        [PengaduanController::class, 'updateStatus']
        )->name('pengaduan.updateStatus');
    });
    
});