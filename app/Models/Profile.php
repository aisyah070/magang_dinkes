<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Nama tabel di database (opsional, hanya jika tabel bukan plural dari model)
    protected $table = 'profiles';

    // Kolom yang bisa diisi (fillable)
    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'foto',
        'admin_id'
    ];

    // Kolom default (jika diperlukan, misalnya timestamp)
    public $timestamps = true;

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah profile dengan nama ' . $model->nama,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengubah profile dengan nama ' . $model->nama,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus profile dengan nama ' . $model->nama,
            ]);
        });
    }
}
