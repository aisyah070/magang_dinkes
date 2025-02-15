<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request; 
use App\Http\Controllers\FotoController;
use App\Models\Foto;
use App\Http\Controllers\VideoController;
use App\Models\Video;
use App\Http\Controllers\ModulController;
use App\Models\Modul;
use App\Http\Controllers\ProfilController;
use App\Models\Profile;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\KategoriFotoController;
use Illuminate\Support\Facades\Route;

// Route untuk dashboard
Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')->middleware('admin');
// Route untuk Data User
Route::get('/user', [UserController::class, 'index'])->name('user')->middleware('admin');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('admin');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
Route::get('/user/edit/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('admin');
Route::put('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->name('user.delete');


// Route untuk Data Modul
// Rute untuk modul
Route::get('/modul', [ModulController::class, 'modul'])->name('modul')->middleware('admin'); // Menampilkan daftar modul
Route::get('/modul/create', [ModulController::class, 'createModul'])->name('modul.create')->middleware('admin'); // Menampilkan form tambah modul
Route::post('/modul/store', [ModulController::class, 'storeModul'])->name('modul.store'); // Menyimpan modul baru
Route::get('/modul/{id}/edit', [ModulController::class, 'editmodul'])->name('modul.edit')->middleware('admin'); // Menampilkan form edit modul
Route::put('/modul/update/{id}', [ModulController::class, 'updatemodul'])->name('modul.update'); // Memperbarui modul
Route::delete('/modul/delete/{id}', [ModulController::class, 'deletemodul'])->name('modul.delete'); // Menghapus modul
Route::get('/modul/lihat/{id}', [ModulController::class, 'lihatModul']);

// Route CRUD Foto
Route::get('/foto', [FotoController::class, 'foto'])->name('foto')->middleware('admin'); // Menampilkan daftar foto
Route::get('/foto/create', [FotoController::class, 'createFoto'])->name('foto.create')->middleware('admin'); // Menampilkan form tambah foto
Route::post('/foto/store', [FotoController::class, 'storeFoto'])->name('foto.store'); // Menyimpan foto baru
Route::get('/foto/{id}/edit', [FotoController::class, 'editFoto'])->name('foto.edit')->middleware('admin'); // Menampilkan form edit foto
Route::put('/foto/{id}', [FotoController::class, 'updateFoto'])->name('foto.update'); // Memperbarui foto
Route::delete('/foto/{id}', [FotoController::class, 'deleteFoto'])->name('foto.delete'); // Menghapus foto
Route::get('/foto/lihat/{id}', [FotoController::class, 'lihatFoto']);

// Kategori Foto
// Kategori Foto
Route::resource('kategori_foto', KategoriFotoController::class)->middleware('admin');


Route::get('password/reset', [ResetPasswordController::class, 'showResetForm'])->name('user.resetPassword');
Route::post('password/reset', [ResetPasswordController::class, 'reset']);


// Route CRUD Video
Route::get('/video', [VideoController::class, 'video'])->name('video')->middleware('admin');
Route::get('/video/create', [VideoController::class, 'createvideo'])->name('video.create')->middleware('admin');
Route::post('/video/store', [VideoController::class, 'storevideo'])->name('video.store');
Route::get('/video/edit/{id}', [VideoController::class, 'editVideo'])->name('video.edit')->middleware('admin');
Route::put('/video/update/{id}', [VideoController::class, 'updateVideo'])->name('video.update');
Route::delete('/video/delete/{id}', [VideoController::class, 'deleteVideo'])->name('video.delete');
Route::delete('/video/onlyDelete/{id}', [VideoController::class, 'deleteOnlyVideo'])->name('video.onlyDelete');
Route::get('/video/lihat/{id}', [VideoController::class, 'lihatVideo']);


// Staff 
Route::get('/profil-staff', [StaffController::class, 'index'])->name('profil-staff.index')->middleware('admin');
Route::get('/profil-staff/create', [StaffController::class, 'create'])->name('profil-staff.create')->middleware('admin');
Route::post('/profil-staff', [StaffController::class, 'store'])->name('profil-staff.store');
Route::get('/profil-staff/{id}/edit', [StaffController::class, 'edit'])->name('profil-staff.edit')->middleware('admin');
Route::put('/profil-staff/{id}', [StaffController::class, 'update'])->name('profil-staff.update');
Route::delete('/profil-staff/{id}', [StaffController::class, 'destroy'])->name('profil-staff.delete');
Route::get('/profil-staff/lihat/{id}', [StaffController::class, 'lihatFoto']);


// Tampilan untuk staff
Route::get('/beranda', function () {
    return view('staff/beranda', [
        "title" => "Beranda"
    ]);
})->middleware('user');

Route::get('/modul-rapat-online', function () {
    return view('staff.moduls.index', [
        "title" => "Modul",
        "data" => Modul::all()
    ]);
})->middleware('user');;

Route::get('/foto-dokumentasi-rapat-online', function () {
    return view('staff.fotos.index', [
        "title" => "Foto",
        "data" => Foto::all()
    ]);
})->middleware('user');;

Route::get('/video-rekaman-rapat-online', function () {
    return view('staff.videos.index', [
        "title" => "Video",
        "data" => Video::all()
    ]);
})->middleware('user');;

Route::get('/profil-karyawan', function () {
    return view('staff.profils.index', [
        "title" => "Profil",
        "data" => Profile::all()
    ]);
})->middleware('user');;

Route::get('/hasil-pencarian', function () {
    return view('staff.hasil.index', [
        "title" => "Hasil"
    ]);
})->middleware('user');;

//Route search
Route::get('/cari', function(Request $request) {
    $query = $request->input('query');
    
    if(!$query){
        return back()->with('error', 'Isi pencarian kosong!!');
    }

    $fotos = Foto::where('judul', 'LIKE', "%$query%")->get();
    $videos = Video::where('judul', 'LIKE', "%$query%")->get();
    $moduls = Modul::where('judul', 'LIKE', "%$query%")->get();

    $result = [ 
        'fotos' => $fotos,
        'videos' => $videos,
        'moduls' => $moduls,
    ];

    return view('staff.hasil.index', [
        'title' => "Hasil",
        'result' => $result,
        'query' => $query,
    ]);
});

//login
Route::get('/login', [UserController::class, 'viewAdminLogin']) ->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'loginAdmin'])->name('admin.login');

Route::get('/', [UserController::class, 'viewLogin'])->name('login.user')->middleware('guest');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');