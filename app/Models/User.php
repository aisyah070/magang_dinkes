<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Pastikan sesuai dengan nama tabel di database

    protected $fillable = ['name', 'email', 'password', 'admin_id'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
