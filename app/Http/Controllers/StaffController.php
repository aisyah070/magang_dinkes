<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class StaffController extends Controller
{
    public function index()
    {
        $data = Profile::all();
        return view('staff.index', compact('data'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|unique:profiles,nip',
            'jabatan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload foto
        $fileFoto = $request->file('foto');
        $namaFile = $request->nama . '-' . time() . '.' . $fileFoto->getClientOriginalExtension();
        $fileFotoPath = $fileFoto->storeAs('profile', $namaFile, 'public');

        // Simpan data ke database
        Profile::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'foto' => $fileFotoPath,
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('profil-staff.index')->with('success', 'Data Profil berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        return view('staff.edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profil = Profile::findOrFail($id);
    
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => "required|unique:profiles,nip,{$id},id",
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $newFileFoto = $request->file('foto');
            $newFileFotoPath = $newFileFoto->storeAs('profile', $request->nama . '-' . time() . '.' . $newFileFoto->getClientOriginalExtension(), 'public');

            if ($profil->foto) {

                Storage::disk('public')->delete($profil->foto);
            }


            $profil->foto = $newFileFotoPath;
        }

        $profil->nama = $request->nama;
        $profil->nip = $request->nip;
        $profil->jabatan = $request->jabatan;
        $profil->admin_id = Auth::guard('admin')->user()->id;
        $profil->save(); // Simpan perubahan

        return redirect()->route('profil-staff.index')->with('success', 'Data profil berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $profil = Profile::findOrFail($id);

        // Hapus foto
        Storage::disk('public')->delete($profil->foto);

        $profil->delete();
        return redirect()->route('profil-staff.index')->with('success', 'Data profil berhasil dihapus.');
    }
}
