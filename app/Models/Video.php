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
        'iframe_video', 
        'file_video',
        'admin_id',
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