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

        return response()->json($pengaduan);
    }
    
    public function index(Request $request)
    {
        return Pengaduan::where('user_id', $request->user()->id)->latest()->get();
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update(['status' => $request->status]);

        return response()->json(['message' => 'status diperbarui',]);
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
