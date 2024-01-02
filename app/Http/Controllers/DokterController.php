<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;
use App\Models\Poli;
use App\Models\Jadwal;
use App\Models\DaftarPoli;
use App\Models\Obat;
use App\Models\Periksa;

class DokterController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $id_akun = session('id');
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $dokter = Dokter::where('id_akun', $id_akun)->first();
        $poli = Dokter::join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('dokter.id', $id_dokter->id)
            ->select('poli.nama_poli')
            ->first();
        $jadwalSaya = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('dokter.id', $id_dokter->id)
            ->first();
        $jumlahAntrian = DaftarPoli::join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->count();
        $pasienTerperiksa = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->where('daftar_poli.status', 'selesai')
            ->count();
        return view('dokter.dashboard')->with(compact('session', 'dokter', 'id_dokter', 'jadwalSaya', 'jumlahAntrian', 'pasienTerperiksa', 'poli'));
    }

    public function showJadwalSaya($id)
    {
        $session = session()->all();
        $dokter = Dokter::where('id', $id)->first();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $cariJadwal = Jadwal::where('id_dokter', $id_dokter->id)->first();
        if ($cariJadwal == null) {
            return redirect(route('dokter.create_jadwal.form'))->with('error', 'Anda belum memiliki jadwal Silahkan Tambahkan Jadwal Anda');
        }
        $jadwal = Jadwal::join('dokter', 'jadwal_periksa.id_dokter', '=', 'dokter.id')
            ->join('poli', 'dokter.id_poli', '=', 'poli.id')
            ->where('dokter.id', $id_dokter->id)
            ->get();
        $jadwal = $jadwal[0];
        return view('dokter.edit_jadwal')->with(compact('session', 'jadwal', 'dokter', 'id_dokter'));
    }

    public function showJadwalForm()
    {
        $session = session()->all();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        // halaman tidak dapat diakses jika dokter sudah memiliki jadwal
        $cariJadwal = Jadwal::where('id_dokter', $dokter->id)->first();
        if ($cariJadwal) {
            return redirect()->route('dokter.jadwal_saya.form', $dokter->id)->with('error', 'Anda sudah memiliki jadwal');
        }
        return view('dokter.create_jadwal')->with(compact('session', 'dokter', 'id_dokter'));
    }

    public function createJadwal(Request $request)
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
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
        return redirect()->route('dokter.jadwal_saya.form', $id_dokter->id)->with('success', 'Jadwal berhasil ditambahkan');
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

    public function manageAntrian()
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        $daftarPoli = DaftarPoli::join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->get();
        $id_pendaftaran = DaftarPoli::join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->where('daftar_poli.status', 'daftar')
            ->pluck('daftar_poli.id');
        // gabungkan id pendaftaran dengan daftar poli
        $daftarPoli = $daftarPoli->map(function ($item, $key) use ($id_pendaftaran) {
            $item['id_pendaftaran'] = $id_pendaftaran[$key];
            return $item;
        });
        return view('dokter.manage_antrian')->with(compact('session', 'daftarPoli', 'dokter', 'id_dokter'));
    }

    public function periksaPasienForm($id)
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        $obat = Obat::all();
        $tgl_sekarang = date('Y-m-d');
        $pasien = DaftarPoli::join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->where('daftar_poli.id', $id)
            ->first();
        // cek apakah pasien sudah pernah diperiksa
        $cekPeriksa = Periksa::where('id_daftar_poli', $id)->first();
        if ($cekPeriksa) {
            return redirect()->back()->with('success', 'Pasien sudah diperiksa');
        }
        return view('dokter.periksa')->with(compact('session', 'dokter', 'id_dokter', 'id', 'obat', 'tgl_sekarang', 'pasien'));
    }

    public function createPeriksa(Request $request)
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $dokter = Dokter::where('id_akun', $session['id'])->first();

        $id_obats = $request->input('selected_obat_ids');
        $id_obat = explode(",", $id_obats);

        $periksa = Periksa::create(
            [
                'id_daftar_poli' => $request->input('id_daftar_poli'),
                'tgl_periksa' => $request->input('tgl_periksa'),
                'catatan' => $request->input('catatan'),
                'biaya_periksa' => $request->input('biaya_periksa'),
            ]
        );

        DaftarPoli::where('id', $request->input('id_daftar_poli'))->update([
            'status' => 'selesai',
        ]);

        $periksa->obat()->attach($id_obat);

        return redirect()->route('dokter.daftar_periksa')->with('success', 'Pasien Sudah Diperiksa', compact('session', 'dokter', 'id_dokter'));
    }

    public function riwayatPeriksa()
    {
        $session = session()->all();
        $id_dokter = Dokter::where('id_akun', $session['id'])->select('id')->first();
        $dokter = Dokter::where('id_akun', $session['id'])->first();
        $oldPasien = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('daftar_poli.status', 'selesai')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->select('pasien.nama', 'daftar_poli.keluhan', 'periksa.tgl_periksa', 'periksa.catatan')
            ->get();
        $idPasien = Periksa::join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
            ->join('pasien', 'daftar_poli.id_pasien', '=', 'pasien.id')
            ->join('jadwal_periksa', 'daftar_poli.id_jadwal', '=', 'jadwal_periksa.id')
            ->where('daftar_poli.status', 'selesai')
            ->where('jadwal_periksa.id_dokter', $id_dokter->id)
            ->select('pasien.id', 'periksa.tgl_periksa', 'periksa.id as id_periksa')
            ->get();

        $periksa = [];
        foreach ($oldPasien as $key => $value) {
            $obat = Periksa::join('detail_periksa', 'periksa.id', '=', 'detail_periksa.id_periksa')
                ->join('obat', 'detail_periksa.id_obat', '=', 'obat.id')
                ->join('daftar_poli', 'periksa.id_daftar_poli', '=', 'daftar_poli.id')
                ->where('daftar_poli.status', 'selesai')
                ->where('periksa.id', $idPasien[$key]->id_periksa)
                ->select('obat.nama_obat')
                ->get();
            $periksa[] = [
                'nama' => $value->nama,
                'keluhan' => $value->keluhan,
                'tgl_periksa' => $value->tgl_periksa,
                'catatan' => $value->catatan,
                'obat' => $obat,
            ];
        }
        // dd($periksa);
        return view('dokter.riwayat_periksa')->with(compact('session', 'dokter', 'id_dokter', 'periksa'));
    }
}
