<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;

class StaffController extends Controller
{
    public function index()
    {
        $data = Staff::all();
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
            'nip' => 'required|unique:staff,nip',
            'jabatan' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Upload foto
        $fotoPath = $request->file('foto')->store('staff', 'public');

        // Simpan data ke database
        Staff::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'foto_path' => $fotoPath,
        ]);

        return redirect()->route('profil-staff.index')->with('success', 'Data staff berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $staff = Staff::findOrFail($id);
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = Staff::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => "required|unique:staff,nip,{$id},staff_id",
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            Storage::disk('public')->delete($staff->foto_path);

            // Upload foto baru
            $fotoPath = $request->file('foto')->store('staff', 'public');
            $staff->foto_path = $fotoPath;
        }

        $staff->update([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
        ]);

        return redirect()->route('profil-staff.index')->with('success', 'Data staff berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $staff = Staff::findOrFail($id);

        // Hapus foto
        Storage::disk('public')->delete($staff->foto_path);

        $staff->delete();
        return redirect()->route('profil-staff.index')->with('success', 'Data staff berhasil dihapus.');
    }
}

