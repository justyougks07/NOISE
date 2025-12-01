<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ChatController;

// Public (no auth)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);

// Protected routes (require Bearer token from Sanctum)
Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/profile',  [AuthController::class, 'profile']);
    Route::post('/logout',  [AuthController::class, 'logout']);

    // Pengaduan
    Route::post('/pengaduan',               [PengaduanController::class, 'store']);      // create
    Route::get('/pengaduan',                [PengaduanController::class, 'index']);      // list user pengaduan
    Route::get('/pengaduan/{id}',           [PengaduanController::class, 'show']);       // detail (optional)
    Route::put('/pengaduan/{id}/status',    [PengaduanController::class, 'updateStatus']); // update status (admin)

    // Chat - using pengaduan id in URL
    Route::post('/pengaduan/{id}/chat',     [ChatController::class, 'send']); // send chat (user or admin)
    Route::get('/pengaduan/{id}/chat',      [ChatController::class, 'list']); // list chats for pengaduan
});
