<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Foto;
use App\Models\KategoriFoto;

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
            'deskripsi' => 'nullable|string',
            'kategori_foto' => 'required|exists:kategori_foto,id',
            'file_foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'tahun' => 'required|integer',
        ]);

        try {
            $filePath = $request->file('file_foto')->store('uploads', 'public');

            Foto::create([
                'judul' => $request->judul,
                'deskripsi' => $request->deskripsi,
                'tahun' => $request->tahun,
                'kategori_id' => $request->kategori_foto,
                'file_foto' => $filePath,
            ]);

            Log::info('Foto berhasil ditambahkan');
            return redirect()->route('foto')->with('success', 'Foto berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menyimpan foto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan foto.');
        }
    }

    // Menampilkan form edit foto
    public function editFoto($id)
    {
        Log::info('Menampilkan form edit foto untuk ID: ' . $id);
        $foto = Foto::findOrFail($id);
        $kategori_foto = KategoriFoto::all();

        return view('foto.edit', compact('foto', 'kategori_foto'));
    }

    // Memperbarui data foto
    public function updateFoto(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tahun' => 'required|integer',
            'kategori_foto' => 'required|exists:kategori_foto,id',
            'file_foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        try {
            $foto = Foto::findOrFail($id);

            if ($request->hasFile('file_foto')) {
                // Hapus file lama jika ada
                if ($foto->file_foto && Storage::exists('public/' . $foto->file_foto)) {
                    Storage::delete('public/' . $foto->file_foto);
                }

                $filePath = $request->file('file_foto')->store('uploads', 'public');
                $foto->file_foto = $filePath;
            }

            // Perbarui data
            $foto->judul = $request->judul;
            $foto->deskripsi = $request->deskripsi;
            $foto->tahun = $request->tahun;
            $foto->kategori_id = $request->kategori_foto;
            $foto->save();

            Log::info('Foto berhasil diperbarui untuk ID: ' . $id);
            return redirect()->route('foto')->with('success', 'Foto berhasil diperbarui!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat memperbarui foto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui foto.');
        }
    }

    // Menghapus foto
    public function deleteFoto($id)
    {
        Log::info('Menghapus foto dengan ID: ' . $id);

        try {
            $foto = Foto::findOrFail($id);

            // Hapus file dari storage jika ada
            if ($foto->file_foto && Storage::exists('public/' . $foto->file_foto)) {
                Storage::delete('public/' . $foto->file_foto);
            }

            $foto->delete();
            Log::info('Foto berhasil dihapus untuk ID: ' . $id);
            return redirect()->route('foto')->with('success', 'Foto berhasil dihapus!');
        } catch (\Exception $e) {
            Log::error('Kesalahan saat menghapus foto: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus foto.');
        }
    }
}
