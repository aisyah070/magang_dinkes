<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\User;
use App\Models\Foto;
use App\Models\Modul;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Mengambil jumlah data dari masing-masing tabel
        $jumlahVideo = Video::count();
        $jumlahUser = User::count();
        $jumlahFoto = Foto::count();
        $jumlahModul = Modul::count();

        // Mengirimkan data ke view
        return view('dashboard', compact('jumlahVideo', 'jumlahUser', 'jumlahFoto', 'jumlahModul'));
    }
}
