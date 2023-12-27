<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Auth;
use App\Models\Poli;

class AdminController extends Controller
{
    public function index()
    {
        $session = session()->all();
        return view('admin.dashboard', compact('session'));
    }

    public function showDokterForm()
    {
        $session = session()->all();
        // select * from poli
        $poli = Poli::all();
        return view('admin.create_dokter', compact('session', 'poli'));
    }

    public function showAllDokter()
    {
        $session = session()->all();
        // select * from dokter join poli on dokter.id_poli = poli.id to get nama poli
        $dokter = Dokter::join('poli', 'dokter.id_poli', '=', 'poli.id')->join('akun', 'dokter.id_akun', '=', 'akun.id')->get();
        return view('admin.manage_dokter', compact('session', 'dokter'));
    }

    public function createDokter(Request $request)
    {
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
            'role' => 'dokter',
        ]);

        Dokter::create([
            'nama' => $request->input('nama'),
            'id_akun' => $akun->id,
            'id_poli' => $request->input('id_poli'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp')
        ]);
        return redirect()->route('admin.manage_dokter')->with('success', 'Dokter berhasil ditambahkan!');
    }

    public function deleteDokter($id)
    {
        // delete dokter where id akun = $id
        $dokter = Dokter::where('id_akun', $id)->first();
        $dokter->delete();
        // delete akun where id = $id
        $akun = Auth::where('id', $id)->first();
        $akun->delete();
        return redirect()->route('admin.manage_dokter')->with('success', 'Dokter berhasil dihapus!');
    }

    public function showEditDokterForm($id)
    {
        $session = session()->all();
        // find dokter where id akun = $id with join akun
        $dokter = Dokter::join('akun', 'dokter.id_akun', '=', 'akun.id')->where('akun.id', $id)->first();
        $poli = Poli::all();
        return view('admin.edit_dokter', compact('session', 'dokter', 'poli'));
    }

    public function editDokter(Request $request, $id)
    {
        // update dokter where id akun = $id
        $dokter = Dokter::where('id_akun', $id)->first();
        // update akun where id = $id
        $akun = Auth::where('id', $id)->first();
        $dokter->update([
            'nama' => $request->input('nama'),
            'id_poli' => $request->input('id_poli'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
        ]);
        if ($request->input('password-baru') != null) {
            // cek apakah password lebih dari 6 karakter
            if (strlen($request->input('password-baru')) < 6) {
                return redirect()->back()->with('error', 'Password minimal 6 karakter!');
            } else {
                // cek apakah password lama benar
                $akun = Auth::where('id', $id)->first();
                if (!password_verify($request->input('password-lama'), $akun->password)) {
                    return redirect()->back()->with('error', 'Password salah!');
                }
                $akun->update([
                    'email' => $request->input('email'),
                    'password' => bcrypt($request->input('password-baru')),
                ]);
            }
        } else {
            $akun->update([
                'email' => $request->input('email'),
            ]);
        }
        return redirect()->route('admin.manage_dokter')->with('success', 'Dokter berhasil diubah!');
    }
}
