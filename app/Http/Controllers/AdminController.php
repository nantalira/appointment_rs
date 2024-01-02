<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Auth;
use App\Models\Poli;
use App\Models\Obat;
use App\Models\Pasien;

class AdminController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $jumlahPasien = Pasien::count();
        $jumlahDokter = Dokter::count();
        $jumlahObat = Obat::count();
        $dokterTiapPoli = Dokter::join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->select('nama_poli as name', Dokter::raw('count(*) as value'))->groupBy('nama_poli')->get();
        return view('admin.dashboard', compact('session', 'jumlahPasien', 'jumlahDokter', 'jumlahObat', 'dokterTiapPoli'));
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
        $dokter = Dokter::leftJoin('poli', 'dokter.id_poli', '=', 'poli.id')->join('akun', 'dokter.id_akun', '=', 'akun.id')->get();
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
        $poli = Poli::all();
        if ($session['role'] == 'dokter') {
            $dokter = Dokter::join('akun', 'dokter.id_akun', '=', 'akun.id')->where('akun.id', $session['id'])->first();
            $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
            return view('admin.edit_dokter', compact('session', 'dokter', 'poli', 'id_dokter'));
        } else if ($session['role'] == 'admin') {
            $dokter = Dokter::join('akun', 'dokter.id_akun', '=', 'akun.id')->where('akun.id', $id)->first();
            return view('admin.edit_dokter', compact('session', 'dokter', 'poli'));
        }
    }

    public function editDokter(Request $request, $id)
    {
        $session = session()->all();
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
        if ($session['role'] == 'dokter') {
            return redirect()->back()->with('success', 'Data berhasil diubah!');
        } else if ($session['role'] == 'admin') {
            return redirect()->route('admin.manage_dokter')->with('success', 'Dokter berhasil diubah!');
        }
    }

    public function showPoliForm()
    {
        $session = session()->all();
        return view('admin.create_poli', compact('session'));
    }

    public function showAllPoli()
    {
        $session = session()->all();
        $poli = Poli::all();
        return view('admin.manage_poli', compact('session', 'poli'));
    }

    public function createPoli(Request $request)
    {
        Poli::create([
            'nama_poli' => $request->input('nama_poli'),
            'keterangan' => $request->input('keterangan'),
        ]);
        return redirect()->route('admin.manage_poli')->with('success', 'Poli berhasil ditambahkan!');
    }

    public function deletePoli($id)
    {
        // delete poli where id = $id
        $poli = Poli::where('id', $id)->first();
        $poli->delete();
        return redirect()->route('admin.manage_poli')->with('success', 'Poli berhasil dihapus!');
    }

    public function showEditPoliForm($id)
    {
        $session = session()->all();
        // find poli where id = $id
        $poli = Poli::where('id', $id)->first();
        return view('admin.edit_poli', compact('session', 'poli'));
    }

    public function editPoli(Request $request, $id)
    {
        // update poli where id = $id
        $poli = Poli::where('id', $id)->first();
        $poli->update([
            'nama_poli' => $request->input('nama_poli'),
            'keterangan' => $request->input('keterangan'),
        ]);
        return redirect()->route('admin.manage_poli')->with('success', 'Poli berhasil diubah!');
    }

    public function showObatForm()
    {
        $session = session()->all();
        return view('admin.create_obat', compact('session'));
    }

    public function showAllObat()
    {
        $session = session()->all();
        $obat = Obat::all();
        return view('admin.manage_obat', compact('session', 'obat'));
    }

    public function createObat(Request $request)
    {
        Obat::create([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => $request->input('harga'),
        ]);
        return redirect()->route('admin.manage_obat')->with('success', 'Obat berhasil ditambahkan!');
    }

    public function deleteObat($id)
    {
        // delete obat where id = $id
        $obat = Obat::where('id', $id)->first();
        $obat->delete();
        return redirect()->route('admin.manage_obat')->with('success', 'Obat berhasil dihapus!');
    }

    public function showEditObatForm($id)
    {
        $session = session()->all();
        // find obat where id = $id
        $obat = Obat::where('id', $id)->first();
        return view('admin.edit_obat', compact('session', 'obat'));
    }

    public function editObat(Request $request, $id)
    {
        // update obat where id = $id
        $obat = Obat::where('id', $id)->first();
        $obat->update([
            'nama_obat' => $request->input('nama_obat'),
            'kemasan' => $request->input('kemasan'),
            'harga' => $request->input('harga'),
        ]);
        return redirect()->route('admin.manage_obat')->with('success', 'Obat berhasil diubah!');
    }

    public function showPasienForm()
    {
        $session = session()->all();
        return view('admin.create_pasien', compact('session'));
    }

    public function showAllPasien()
    {
        $session = session()->all();
        // select * from pasien join akun on pasien.id_akun = akun.id
        $pasien = Pasien::join('akun', 'pasien.id_akun', '=', 'akun.id')->get();
        return view('admin.manage_pasien', compact('session', 'pasien'));
    }

    public function createPasien(Request $request)
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
        return redirect()->route('admin.manage_pasien')->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function deletePasien($id)
    {
        // delete pasien where id akun = $id
        $pasien = Pasien::where('id_akun', $id)->first();
        $pasien->delete();
        // delete akun where id = $id
        $akun = Auth::where('id', $id)->first();
        $akun->delete();
        return redirect()->route('admin.manage_pasien')->with('success', 'Pasien berhasil dihapus!');
    }

    public function showEditPasienForm($id)
    {
        $session = session()->all();
        // find pasien where id akun = $id with join akun
        $pasien = Pasien::join('akun', 'pasien.id_akun', '=', 'akun.id')->where('akun.id', $id)->first();
        return view('admin.edit_pasien', compact('session', 'pasien'));
    }

    public function editPasien(Request $request, $id)
    {
        // update pasien where id akun = $id
        $pasien = Pasien::where('id_akun', $id)->first();
        // update akun where id = $id
        $akun = Auth::where('id', $id)->first();
        $pasien->update([
            'nama' => $request->input('nama'),
            'alamat' => $request->input('alamat'),
            'no_hp' => $request->input('no_hp'),
            'no_ktp' => $request->input('no_ktp'),
            'no_rm' => $request->input('no_rm'),
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
        return redirect()->route('admin.manage_pasien')->with('success', 'Pasien berhasil diubah!');
    }
}
