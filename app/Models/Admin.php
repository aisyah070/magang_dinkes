<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasFactory;

    protected $table = 'admins'; // Nama tabel

    protected $fillable = ['NAMA', 'EMAIL', 'PASSWORD']; // Kolom yang dapat diisi massal

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

    public function modul()
    {
        return $this->hasMany(Modul::class);
    }

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function profile()
    {
        return $this->hasMany(Profile::class);
    }
}
