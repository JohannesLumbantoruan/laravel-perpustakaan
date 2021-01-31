<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Model;
use Illuminate\Contracts\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;

class Petugas extends Model
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'petugas';
    protected $fillable = [
        'nama',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
