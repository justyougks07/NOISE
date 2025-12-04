<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengaduan;

class PengaduanController extends Controller
{
    Public function store(Request $request)
    {
        $request->validate([
            'laporan' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengaduan_foto', 'public');
        }

        $pengaduan = Pengaduan::create([
            'user_id' => $request->user()->id,
            'laporan' => $request->laporan,
            'foto' => $fotoPath,
            'status' => 'pending'
        ]);

        return redirect()->route('user.pengaduan.show', $pengaduan->id)->with('success', 'Pengaduan berhasil dibuat!');
    }
    
    public function index(Request $request)
{
    $query = Pengaduan::where('user_id', auth()->id());

    if ($request->status) {
        $query->where('status', $request->status);
    }

    $pengaduan = $query->latest()->get();

    return view('user.pengaduan.index', compact('pengaduan'));
}


    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:pending,dalam pengerjaan,selesai'  // Tambah validasi enum untuk keamanan
    ]);

    $pengaduan = Pengaduan::findOrFail($id);
    $pengaduan->update(['status' => $request->status]);

    // Jika request dari web (bukan API), redirect dengan flash message
    if (!$request->wantsJson()) {
        return redirect()->back()->with('success', 'Status pengaduan berhasil diperbarui!');
    }

    // Jika API, return JSON
    return response()->json(['message' => 'Status diperbarui']);
}
    public function show(Request $request, $id)
{
    $pengaduan = Pengaduan::with('chats.user')->findOrFail($id);

    // akses kontrol: user hanya bisa lihat pengaduan sendiri
    if ($request->user()->role === 'user' && $pengaduan->user_id !== $request->user()->id) {
        return response()->json(['message' => 'Tidak punya akses'], 403);
    }

    return response()->json($pengaduan);
}

}
