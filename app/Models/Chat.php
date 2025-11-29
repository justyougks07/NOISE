<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Chat extends Model
{
    use HasFactory;

    protected $table = 'chat';

    protected $fillable = [
        'pengaduan_id',
        'user_id',     
        'pesan',
    ];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
