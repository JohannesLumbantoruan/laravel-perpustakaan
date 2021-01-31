<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $primaryKey = 'peminjaman_id';
    protected $fillable = [
        'peminjaman_buku',
        'peminjaman_anggota',
        'peminjaman_tanggal_mulai',
        'peminjaman_tanggal_sampai',
        'peminjaman_status',
    ];

    public function buku()
    {
        return $this->hasOne(Buku::class, 'id', 'peminjaman_buku');
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class, 'id', 'peminjaman_anggota');
    }
}
