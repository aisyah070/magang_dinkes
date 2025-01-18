<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Profile; // Model untuk profil karyawan

class ProfilController extends Controller
{
    // Tampilkan daftar semua profil
    public function index()
    {
        $data = Profile::all(); // Ambil semua data profil
        return view('profile.index', compact('data'));
    }

    // Tampilkan form tambah profil baru
    public function create()
    {
        return view('profile.create');
    }

    // Simpan data profil baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:16',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $data = $request->only(['nama', 'jabatan']);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        Profile::create($data);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil ditambahkan.');
    }

    // Tampilkan form edit profil berdasarkan ID
    public function edit($id)
    {
        $profile = Profile::findOrFail($id); // Cari profil berdasarkan ID
        return view('profile.edit', compact('profile'));
    }

    // Perbarui data profil di database
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|max:16',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $profile = Profile::findOrFail($id);

        $data = $request->only(['nama', 'jabatan']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($profile->foto && Storage::exists('public/' . $profile->foto)) {
                Storage::delete('public/' . $profile->foto);
            }
            $data['foto'] = $request->file('foto')->store('profile', 'public');
        }

        $profile->update($data);

        return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
    }

    // Hapus profil berdasarkan ID
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);

        // Hapus foto jika ada
        if ($profile->foto && Storage::exists('public/' . $profile->foto)) {
            Storage::delete('public/' . $profile->foto);
        }

        $profile->delete();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil dihapus.');
    }
}
