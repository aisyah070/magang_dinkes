<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'dokumentasi';

    public static function getByJenisDokumen($jenis)
    {
        return self::where('jenis_dokumen', $jenis)->get();
    }
}
