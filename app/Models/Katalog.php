<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Katalog extends Model
{
    use HasFactory;

    protected $table = 'katalog';
    protected $primaryKey = 'id';
    protected $fillable = [
        'judul',
        'deskripsi',
        'tag',
        'foto',
        'penulis',
        'tgl_input',
    ];
}
