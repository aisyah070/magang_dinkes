<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Pastikan sesuai dengan nama tabel di database

    protected $fillable = ['name', 'email', 'password', 'admin_name'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            Activity::create([
                'description' => 'Menambah user dengan nama ' . $model->name,
            ]);
        });

        static::updating(function ($model) {
            Activity::create([
                'description' => 'Mengubah user dengan nama ' . $model->name,
            ]);
        });

        static::deleting(function ($model) {
            Activity::create([
                'description' => 'Menghapus user dengan nama ' . $model->name,
            ]);
        });
    }
}
