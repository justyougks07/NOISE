<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengaduan extends Model
{
    use HasFactory;

    // Nama tabel di database (default Eloquent biasanya plural, ini dipaksa sesuai migration)
    protected $table = 'pengaduan';

    // Kolom yang boleh diisi mass-assignment (mengamankan mass assignment)
    protected $fillable = [
        'user_id',
        'laporan',
        'foto',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function chat()
    {
        return $this->hasMany(Chat::class);
    }
}
