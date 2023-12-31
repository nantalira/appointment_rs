<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Jadwal;

class DokterController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $id_akun = session('id');
        $dokter = Dokter::where('id_akun', $id_akun)->first();
        return view('dokter.dashboard')->with(compact('session', 'dokter'));
    }

    public function showJadwalSaya($id)
    {
        $session = session()->all();
        $dokter = Dokter::where('id', $id)->first();
        $cariJadwal = Jadwal::where('id_dokter', $dokter->id)->first();
        if ($cariJadwal == null) {
            return redirect(route('dokter.create_jadwal.form'))->with('error', 'Anda belum memiliki jadwal Silahkan Tambahkan Jadwal Anda');
        }
        $jadwal = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('dokter.id', $dokter->id)
            ->get();
        $jadwal = $jadwal[0];
        return view('dokter.edit_jadwal')->with(compact('session', 'jadwal', 'dokter'));
    }

    public function showJadwalForm()
    {
        $session = session()->all();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        // halaman tidak dapat diakses jika dokter sudah memiliki jadwal
        $cariJadwal = Jadwal::where('id_dokter', $dokter->id)->first();
        if ($cariJadwal) {
            return redirect()->route('dokter.jadwal_saya.form', $dokter->id)->with('error', 'Anda sudah memiliki jadwal');
        }
        return view('dokter.create_jadwal')->with(compact('session', 'dokter'));
    }

    public function createJadwal(Request $request)
    {
        $session = session()->all();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        // cek apakah terdapat jadwal yang sama pada dokter di poli yang sama
        $jadwalSama = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->where('id_poli', $dokter->id_poli)
            ->where('hari', $request->input('hari'))
            ->where('jam_mulai', $request->input('jam_mulai'))
            ->where('jam_selesai', $request->input('jam_selesai'))
            ->first();
        if ($jadwalSama) {
            return redirect()->back()->with('error', 'Jadwal anda bertabrakan dengan jadwal dokter lain');
        }
        Jadwal::create([
            'id_dokter' => $dokter->id,
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);
        return redirect()->route('dokter.jadwal_saya.form', $dokter['id'])->with('success', 'Jadwal berhasil ditambahkan');
    }

    public function editJadwal(Request $request, $id)
    {
        $dokter = Dokter::where('id', $id)->first();
        $jadwal = Jadwal::where('id_dokter', $dokter->id)->first();
        // cek apakah terdapat jadwal yang sama pada dokter di poli yang sama
        $jadwalSama = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->where('id_poli', $dokter->id_poli)
            ->where('hari', $request->input('hari'))
            ->where('jam_mulai', $request->input('jam_mulai'))
            ->where('jam_selesai', $request->input('jam_selesai'))
            ->first();
        if ($jadwalSama) {
            return redirect()->back()->with('error', 'Jadwal anda bertabrakan dengan jadwal dokter lain');
        }
        $jadwal->update([
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);
        return redirect()->route('dokter.jadwal_saya.form', $dokter->id)->with('success', 'Jadwal berhasil diubah');
    }
}
