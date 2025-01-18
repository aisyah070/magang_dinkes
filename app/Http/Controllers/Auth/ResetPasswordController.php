<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ResetPasswordController extends Controller
{
    // Menampilkan form reset password
    public function showResetForm(Request $request)
    {
        return view('auth.passwords.reset')->with(['token' => $request->token, 'email' => $request->email]);
    }

    // Menangani pengaturan ulang password
    public function reset(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Mengatur ulang password
        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __('Your password has been reset!'))
            : back()->withErrors(['email' => __('There was an error resetting your password.')]);
    }
}