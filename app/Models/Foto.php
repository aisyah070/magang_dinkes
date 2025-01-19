<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos'; // Nama tabel di database
    protected $fillable = [
        'judul',
        'deskripsi',
        'kategori_id', // Pastikan ini sesuai dengan kolom di tabel
        'tahun',       // Kolom tahun
        'file_foto',   // Pastikan ini sesuai dengan nama kolom di tabel
        'admin_id',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriFoto::class, 'kategori_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah foto Baru dengan judul ' . $model->nama,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengedit foto dengan nama ' . $model->nama,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus foto dengan nama' . $model->nama,
            ]);
        });
    }
}