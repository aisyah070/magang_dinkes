<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriFoto;

class KategoriFotoController extends Controller
{
    public function index()

    {
        $kategori_fotos = KategoriFoto::all();
        $title  = 'Kategori Foto';
        return view('kategori_foto', compact('kategori_fotos', 'title'));
    }

    public function create()
    {
        return view('kategori_foto.create',[
            'title' => 'Tambah Kategori Foto',
        ]);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
        ]);

        KategoriFoto::create([
            'nama_kategori' => $request->nama_kategori,
        ]);
        return redirect()->route('kategori_foto.index')->with('success', 'Kategori foto berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kategori_foto = KategoriFoto::findOrFail($id);
        $title  = 'Edit Kategori Foto';

        return view('kategori_foto.edit', compact('kategori_foto', 'title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
        ]);

        $kategori_foto = KategoriFoto::findOrFail($id);
        $kategori_foto->update($request->only('nama_kategori'));
        return redirect()->route('kategori_foto.index')->with('success', 'Kategori foto berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kategori_foto = KategoriFoto::findOrFail($id);
        $kategori_foto->delete();
        return redirect()->route('kategori_foto.index')->with('success', 'Kategori foto berhasil dihapus.');
    }
}
