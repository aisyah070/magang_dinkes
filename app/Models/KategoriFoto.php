<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriFoto extends Model
{
    protected $table = 'kategori_foto';
    protected $fillable = ['nama_kategori'];

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah kategori dengan nama ' . $model->nama_kategori,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengubah kategori dengan nama ' . $model->nama_kategori,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus kategori dengan nama ' . $model->nama_kategori,
            ]);
        });
    }
}
