<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pasien;

class PasienController extends Controller
{
    public function index()
    {
        $session = session()->all();
        $id_akun = session('id');
        $pasien = Pasien::where('id_akun', $id_akun)->first();
        return view('pasien.dashboard')->with(compact('session', 'pasien'));
    }
}
