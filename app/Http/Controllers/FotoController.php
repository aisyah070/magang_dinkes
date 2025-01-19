<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Foto;
use App\Models\KategoriFoto;
use Illuminate\Support\Facades\Auth;

class FotoController extends Controller
{
    // Menampilkan daftar foto dengan pagination
    public function foto()
    {
        Log::info('Menampilkan daftar foto');
        $data = Foto::with('kategori')->paginate(10); // Ambil data dengan relasi kategori
        $kategori_foto = KategoriFoto::all();

        return view('foto', compact('data', 'kategori_foto'));
    }

    // Menampilkan form tambah foto
    public function createFoto()
    {
        Log::info('Menampilkan form tambah foto');
        $kategori_foto = KategoriFoto::all();

        return view('foto.create', compact('kategori_foto'));
    }

    // Menyimpan foto baru ke database
    public function storeFoto(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kategori_id' => 'required|exists:kategori_foto,id',
            'file_foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $fileFoto = $request->file('file_foto');
        $namaFile = $request->judul . '-' . time() . '.' . $fileFoto->getClientOriginalExtension();
        $fileFotoPath = $fileFoto->storeAs('Fotos', $namaFile, 'public');


        $admin = Auth::guard('admin')->user()->id;


        // Menyimpan data ke database
        Foto::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'file_foto' => $fileFotoPath,
            'admin_id' => $admin,
        ]);

        return redirect()->route('foto')->with('success', 'Foto berhasil diunggah');
    }

    public function editFoto($id)
    {
        $foto = Foto::findOrFail($id);
        $kategori_foto = KategoriFoto::all();

        return view('foto.edit', compact('foto', 'kategori_foto'));
    }

    // Memperbarui data foto
    public function updateFoto(Request $request, $id)
    {
        $foto = Foto::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori_id' => 'required|exists:kategori_foto,id',
            'file_foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('file_foto')) {
            $newFileFoto = $request->file('file_foto');
            $newFileFotoPath = $newFileFoto->storeAs('fotos', $request->judul . '-' . time() . '.' . $newFileFoto->getClientOriginalExtension(), 'public');

            if ($foto->file_foto) {

                Storage::disk('public')->delete($foto->file_foto);
            }


            $foto->file_foto = $newFileFotoPath;
        }

        $foto->judul = $request->judul;
        $foto->deskripsi = $request->deskripsi;
        $foto->admin_id = Auth::guard('admin')->user()->id;
        $foto->save(); // Simpan perubahan

        return redirect()->route('foto')->with('success', 'Foto berhasil diperbarui');
    }

    // Menghapus foto
    public function deleteFoto($id)
    {
        $foto = Foto::findOrFail($id);

        // Menghapus modul dari penyimpanan
        if ($foto->file_foto) {
            Storage::disk('public')->delete($foto->file_foto);
        }

        $foto->delete();

        return redirect()->route('foto')->with('success', 'Foto berhasil dihapus');
    }
}
