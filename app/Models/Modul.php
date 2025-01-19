<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    // Menentukan kolom yang dapat diisi secara massal
    protected $fillable = ['judul', 'deskripsi', 'tahun', 'file_modul', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah modul dengan nama ' . $model->judul,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengubah modul dengan nama ' . $model->judul,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus modul dengan nama ' . $model->judul,
            ]);
        });
    }
}