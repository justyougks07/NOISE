<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Pengaduan;

class ChatController extends Controller
{
    public function send(Request $request, $pengaduan_id)
    {
        $request->validate([
            'pesan' => 'required',
        ]);

        $pengaduan = Pengaduan::findOrFail($pengaduan_id);

        if ($request->user()->role === 'user' && $pengaduan->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Tidak punya akses'], 403);
        }

        $chat = Chat::create([
            'pengaduan_id' => $pengaduan_id,
            'user_id' => $request->user()->id,
            'pesan' => $request->pesan,
        ]);

        return response()->json($chat);
    }

    public function list(Request $request, $pengaduan_id)
    {
        $pengaduan = Pengaduan::findOrFail($pengaduan_id);
        
        if ($request->user()->role === 'user' && $pengaduan->user_id !== $request->user()->id) {
            return response()->json(['message' => 'Tidak punya akses'], 403);
        }

        return Chat::where('pengaduan_id', $pengaduan_id)
                    ->with('user:id,name,role')
                    ->orderBy('created_at')
                    ->get();
    }
}
