<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'isbn',
        'tahun',
        'penulis',
        'kategori',
        'jumlah',
        'deskripsi',
        'penerbit',
        'cover',
        'status',
    ];

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class);
    }

    public function category()
    {
        return $this->hasOne(Kategori::class, 'kategori_id', 'kategori');
    }
}
