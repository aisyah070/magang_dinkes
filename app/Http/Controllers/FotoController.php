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
        $title  = 'Foto';

        return view('foto', compact('data', 'kategori_foto','title'));
    }

    // Menampilkan form tambah foto
    public function createFoto()
    {
        Log::info('Menampilkan form tambah foto');
        $kategori_foto = KategoriFoto::all();
        $title  = 'Tambah Foto';

        return view('foto.create', compact('kategori_foto', 'title'));
    }

    // Menyimpan foto baru ke database
    public function storeFoto(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
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
            'file_foto' => $namaFile,
            'admin_id' => $admin,
        ]);

        return redirect()->route('foto')->with('success', 'Foto berhasil diunggah');
    }

    public function editFoto($id)
    {
        $foto = Foto::findOrFail($id);
        $kategori_foto = KategoriFoto::all();
        $title  = 'Edit Foto';

        return view('foto.edit', compact('foto', 'kategori_foto', 'title'));
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
            $newNamaFle = basename($newFileFotoPath);

            if ($foto->file_foto) {

                Storage::disk('public')->delete('/fotos/' . $foto->file_foto);
            }


            $foto->file_foto = $newNamaFle;
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

    public function lihatFoto($id)
    {
        $foto = Foto::findOrFail($id);

        $path = storage_path('app/public/fotos/' . $foto->file_foto);
        $mimeType = mime_content_type($path);

        return response()->file($path, [
            'Content-Type' => $mimeType
        ]);
    }
}
