<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokter;

class DokterController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $id_akun = session('id');
        $dokter = Dokter::where('id_akun', $id_akun)->first();
        return view('dokter.dashboard')->with(compact('session', 'dokter'));
    }
}
