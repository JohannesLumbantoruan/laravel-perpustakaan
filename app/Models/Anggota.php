<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'no_hp',
        'jumlah_peminjaman',
        'jumlah_dipinjam',
        'alamat',
        'foto',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }
}
