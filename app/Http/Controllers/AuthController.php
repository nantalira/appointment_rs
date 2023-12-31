<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auth;
use App\Models\Pasien;
use App\Models\Dokter;

class AuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        // cek apakah no ktp sudah terdaftar
        $no_ktp = Pasien::where('no_ktp', $request->input('no_ktp'))->first();
        if ($no_ktp) {
            return redirect()->back()->with('error', 'No KTP sudah terdaftar!');
        }

        // cek apakah email sudah terdaftar
        $email = Auth::where('email', $request->input('email'))->first();
        if ($email) {
            return redirect()->back()->with('error', 'Email sudah terdaftar!');
        }

        // cek apakah password lebih dari 6 karakter
        if (strlen($request->input('password')) < 6) {
            return redirect()->back()->with('error', 'Password minimal 6 karakter!');
        }

        // Simpan ke tabel Akun
        $akun = Auth::create([
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'role' => 'pasien',
        ]);

        $year = date('Y'); // Get the current year
        $month = date('m'); // Get the current month
        $all_patients = Pasien::count();
        $no_rm = $year . $month . '-' . ($all_patients + 1); // Generate the no_rm

        Pasien::create([
            'nama' => $request->input('nama'),
            'id_akun' => $akun->id,
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'no_ktp' => $request->input('no_ktp'),
            'no_rm' => $no_rm, // Assign the generated no_rm
        ]);

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        // Cari akun berdasarkan email
        $akun = Auth::where('email', $request->input('email'))->first();

        $dokter = Dokter::where('id_akun', $akun->id)->first();
        $pasien = Pasien::where('id_akun', $akun->id)->first();

        // Jika akun tidak ditemukan
        if (!$akun) {
            return redirect()->back()->with('error', 'Email tidak ditemukan!');
        }
        // Jika password salah atau kurang dari 6 karakter

        if (strlen($request->input('password')) < 6) {
            return redirect()->back()->with('error', 'Password minimal 6 karakter!');
        } else if (!password_verify($request->input('password'), $akun->password)) {
            return redirect()->back()->with('error', 'Password salah!');
        }
        // Simpan informasi akun ke dalam session
        $request->session()->put('id', $akun->id);
        $request->session()->put('email', $akun->email);
        $request->session()->put('role', $akun->role);

        if ($akun->role == 'pasien') {
            return redirect()->route('pasien.dashboard.form')->with('pasien', $pasien);
        } else if ($akun->role == 'admin') {
            return redirect()->route('admin.dashboard')->with('akun', $akun);
        } else if ($akun->role == 'dokter') {
            return redirect()->route('dokter.dashboard')->with('dokter', $dokter);
        }
    }

    public function logout(Request $request)
    {
        // Hapus session
        $request->session()->forget('id');
        $request->session()->forget('email');
        $request->session()->forget('role');

        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }
}
