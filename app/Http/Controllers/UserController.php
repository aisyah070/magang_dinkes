<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
        $title  = 'User';
        return view('user', compact('data', 'title')); // Pastikan view sesuai
    }

    public function create()
    {
        return view('user.create', [
            'title' => 'Tambah User',
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed', // Menambahkan konfirmasi password
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Membuat user baru
        User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'admin_id' => Auth::guard('admin')->user()->id,
        ]);

        return redirect()->route('user')->with('success', 'User  berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);
        $title  = 'Edit User';
        return view('user.edit', compact('data', 'title'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:6|confirmed', // Menambahkan konfirmasi password
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Update data pengguna
        $data = [
            'email' => $request->email,
            'name' => $request->name,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        User::whereId($id)->update($data);

        return redirect()->route('user')->with('success', 'User  berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('user')->with('success', 'User  berhasil dihapus!');
    }

    public function viewLogin(){
        return view('auth.user.login');
    }

    public function viewAdminLogin(){
        return view('auth.admin.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/beranda');
        }

        return back()->with('error', 'Login Gagal!!');
    }

    public function loginAdmin(Request $request){
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        
        if(Auth::guard('admin')->attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('error', 'Login Gagal!!');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}