<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class ModulController extends Controller
{
    public function modul()
    {
        $data = Modul::all(); // Mengambil semua data modul dari tabel 'moduls'
        $title  = 'Modul';
        return view('modul', compact('data', 'title')); // Mengirim data modul ke view 'modul'
    }

    public function createModul()
    {
        return view('modul.create', [
            'title' => 'Tambah Modul',
        ]); // Menampilkan form untuk menambahkan modul baru
    }

    public function storeModul(Request $request)
    {
        // Validasi data
        $request->validate([
            'judul' => 'required|string|max:255',
            'file_modul' => 'required|mimes:pdf,doc,docx,ppt|max:10000', // Maksimal 10 MB
        ]);

        // Proses upload modul
        $fileModul = $request->file('file_modul');
        $namaFile = $request->judul . '-' . time() . '.' . $fileModul->getClientOriginalExtension();
        $fileModulPath = $fileModul->storeAs('modul_uploads', $namaFile, 'public');


        $admin = Auth::guard('admin')->user()->id;
        

        // Menyimpan data ke database
        Modul::create([
            'judul' => $request->judul,
            'file_modul' => $fileModulPath,
            'admin_id' => $admin,
        ]);

        return redirect()->route('modul')->with('success', 'Modul berhasil diunggah');
    }

    public function editModul($id)
    {
        $modul = Modul::findOrFail($id);
        $title  = 'Edit Modul';
        return view('modul.edit', compact('modul','title'));
    }

    public function updateModul(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);

        // Validasi data
        $request->validate([
            'judul' => 'nullable|string|max:255',
            'file_modul' => 'nullable|mimes:pdf,doc,docx,ppt|max:5120', // Maksimal 5 MB
        ]);

        // Mengganti modul jika ada file baru yang diupload
        if ($request->hasFile('file_modul')) {
            $newFileModul = $request->file('file_modul');
            $newFileModulPath = $newFileModul->storeAs('modul_uploads', $request->judul . '-' . time() . '.' . $newFileModul->getClientOriginalExtension(), 'public');
            // Menghapus modul lama
            if ($modul->file_modul) {

                Storage::disk('public')->delete($modul->file_modul);
            }

            // Memperbarui path modul di database
            $modul->file_modul = $newFileModulPath;
        }

        $modul->judul = $request->judul;
        $modul->admin_id = Auth::guard('admin')->user()->id;
        $modul->save(); // Simpan perubahan

        return redirect()->route('modul')->with('success', 'Modul berhasil diperbarui');
    }

    public function deleteModul($id)
    {
        $modul = Modul::findOrFail($id);

        // Menghapus modul dari penyimpanan
        if ($modul->file_modul) {
            Storage::disk('public')->delete($modul->file_modul);
        }

        // Menghapus data modul dari database
        $modul->delete();

        return redirect()->route('modul')->with('success', 'Modul berhasil dihapus');
    }
} 