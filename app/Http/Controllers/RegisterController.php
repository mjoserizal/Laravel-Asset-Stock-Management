<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;

class RegisterController extends Controller
{
    // UserController.php

    public function register(Request $request)
    {
        // Validasi input pengguna (email, password, dll.)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            // tambahkan validasi lainnya di sini sesuai kebutuhan
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'team_id' => 1,
            // tambahkan kolom lainnya sesuai kebutuhan
        ]);

        // Menetapkan peran default (ID 2) kepada pengguna baru
        $user->roles()->attach(2); // 2 adalah ID dari peran 'user'
        return redirect('/');
        // Lanjutkan dengan logika redirect atau respons setelah registrasi
    }

}
