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
        'iframe_vjuduleo', // Ganti 'url_vjuduleo' dengan 'iframe_vjuduleo' jika Anda menggunakan URL embed
        'file_vjuduleo',
        'nama_file', // Ganti 'namavjuduleo' dengan 'nama_file'
        'tahun', // Pastikan untuk menambahkan tahun jika Anda ingin menyimpannya
        'admin_judul',
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah vjuduleo dengan nama ' . $model->judul,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengubah vjuduleo dengan nama ' . $model->judul,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus vjuduleo dengan nama ' . $model->judul,
            ]);
        });
    }
}