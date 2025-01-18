<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'deskripsi',
        'iframe_video', // Ganti 'url_video' dengan 'iframe_video' jika Anda menggunakan URL embed
        'file_video',
        'nama_file', // Ganti 'namavideo' dengan 'nama_file'
        'tahun', // Pastikan untuk menambahkan tahun jika Anda ingin menyimpannya
        'admin_id',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}