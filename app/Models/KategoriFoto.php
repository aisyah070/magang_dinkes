<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriFoto extends Model
{
    protected $table = 'kategori_foto';
    protected $fillable = ['nama_kategori'];
    public $timestamps = false;

    public function fotos()
    {
        return $this->hasMany(Foto::class);
    }
}
