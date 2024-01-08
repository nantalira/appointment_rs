<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;
use App\Models\Jadwal;
use App\Models\DaftarPoli;

class PasienController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $id_akun = session('id');
        $pasien = Pasien::where('id_akun', $id_akun)->first();
        $jadwal = Jadwal::select('jadwal_periksa.id as id_jadwal', 'jadwal_periksa.*', 'dokter.*', 'poli.*')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->get();
        $jadwalUnik = [];
        foreach ($jadwal as $key => $value) {
            $cekAntrianPerPoli = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
                ->join('poli', 'dokter.id_poli', '=', 'poli.id')
                ->join('daftar_poli', 'jadwal_periksa.id', '=', 'daftar_poli.id_jadwal')
                ->where('jadwal_periksa.id', $value->id_jadwal)
                ->where('daftar_poli.status', 'daftar')
                ->count();
            $antrianSaya = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
                ->where('daftar_poli.status', 'daftar')
                ->where('daftar_poli.id_pasien', $pasien->id)
                ->where('jadwal_periksa.id', $value->id_jadwal)
                ->select('daftar_poli.no_antrian')
                ->max('daftar_poli.no_antrian');
            $namaPoli = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
                ->join('poli', 'dokter.id_poli', '=', 'poli.id')
                ->where('jadwal_periksa.id', $value->id_jadwal)
                ->select('poli.nama_poli', 'dokter.*')
                ->first();

            $cekAntrianPerPoli = $cekAntrianPerPoli - 1;
            if ($cekAntrianPerPoli < 0) {
                $cekAntrianPerPoli = 0;
            }

            $jadwalUnik[] = [
                'antriSebelum' => $cekAntrianPerPoli,
                'antrianSaya' => $antrianSaya,
                'namaPoli' => $namaPoli->nama_poli,
                'namaDokter' => $namaPoli->nama
            ];
        }


        return view('pasien.dashboard')->with(compact('session', 'pasien', 'jadwal', 'jadwalUnik'));
    }

    public function pendaftaranPoli(Request $request)
    {
        $AntrianPerPoli = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->join('daftar_poli', 'jadwal_periksa.id', '=', 'daftar_poli.id_jadwal')
            ->where('jadwal_periksa.id', $request->input('id_jadwal'))
            ->max('daftar_poli.no_antrian');
        $cekAntrianPerPoli = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('daftar_poli.id_pasien', $request->input('id'))
            ->where('jadwal_periksa.id', $request->input('id_jadwal'))
            ->orderBy('daftar_poli.id', 'desc')
            ->select('daftar_poli.status')
            ->value('status');
        if ($cekAntrianPerPoli == 'daftar') {
            return redirect()->route('pasien.dashboard.form')->with('error', 'Anda Sudah Terdaftar Pada Antrian Poli Ini');
        } else {
            $no_antrian = $AntrianPerPoli + 1;
            DaftarPoli::create([
                'id_pasien' => $request->input('id'),
                'id_jadwal' => $request->input('id_jadwal'),
                'keluhan' => $request->input('keluhan'),
                'no_antrian' => $no_antrian,
                'status' => 'daftar'
            ]);
            return redirect()->route('pasien.dashboard.form')->with('success', 'Pendaftaran Berhasil');
        }
    }
}
