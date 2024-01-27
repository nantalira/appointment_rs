<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\DokterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('role:pasien')->get('/dashboard-pasien', [PasienController::class, 'index'])->name('pasien.dashboard.form');
Route::middleware('role:pasien')->post('/pendaftaran-poli', [PasienController::class, 'pendaftaranPoli'])->name('pasien.pendaftaran_poli');

Route::middleware('role:dokter')->get('/dashboard-dokter', [DokterController::class, 'index'])->name('dokter.dashboard');
Route::middleware('role:dokter')->get('/jadwal-saya/{id}', [DokterController::class, 'showJadwalSaya'])->name('dokter.jadwal_saya.form');
Route::middleware('role:dokter')->put('/jadwal-saya/{id}', [DokterController::class, 'editJadwal'])->name('dokter.jadwal_saya');
Route::middleware('role:dokter')->get('/jadwal-saya', [DokterController::class, 'showJadwalForm'])->name('dokter.create_jadwal.form');
Route::middleware('role:dokter')->post('/jadwal-saya', [DokterController::class, 'createJadwal'])->name('dokter.create_jadwal');
Route::middleware('role:dokter')->get('/daftar-periksa', [DokterController::class, 'manageAntrian'])->name('dokter.daftar_periksa');
Route::middleware('role:dokter')->get('/pemeriksaan/{id}', [DokterController::class, 'periksaPasienForm'])->name('dokter.periksa.form');
Route::middleware('role:dokter')->post('/create-periksa', [DokterController::class, 'createPeriksa'])->name('dokter.periksa');
Route::middleware('role:dokter')->get('/riwayat-periksa', [DokterController::class, 'riwayatPeriksa'])->name('dokter.riwayat_periksa');
Route::middleware('role:dokter')->get('/manage_jadwal/{id}', [DokterController::class, 'showAllJadwal'])->name('dokter.manage_jadwal');
Route::middleware('role:dokter')->get('/edit-jadwal/{id}', [DokterController::class, 'showJadwal'])->name('dokter.edit_jadwal.form');
Route::middleware('role:dokter')->put('/edit-jadwal/{id}', [DokterController::class, 'changeJadwal'])->name('dokter.edit_jadwal');
// Route::middleware('role:dokter')->delete('/delete-jadwal/{id}', [DokterController::class, 'deleteJadwal'])->name('dokter.delete_jadwal');

Route::middleware('role:admin')->get('/dashboard-admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::middleware('role:admin')->get('/create-dokter', [AdminController::class, 'showDokterForm'])->name('admin.create_dokter.form');
Route::middleware('role:admin')->post('/create-dokter', [AdminController::class, 'createDokter'])->name('admin.create_dokter');
Route::middleware('role:admin')->get('/all-dokter', [AdminController::class, 'showAllDokter'])->name('admin.manage_dokter');
Route::middleware('role:admin')->delete('/delete-dokter/{id}', [AdminController::class, 'deleteDokter'])->name('admin.delete_dokter');
Route::middleware('role:admin')->get('/create-poli', [AdminController::class, 'showPoliForm'])->name('admin.create_poli.form');
Route::middleware('role:admin')->post('/create-poli', [AdminController::class, 'createPoli'])->name('admin.create_poli');
Route::middleware('role:admin')->get('/all-poli', [AdminController::class, 'showAllPoli'])->name('admin.manage_poli');
Route::middleware('role:admin')->delete('/delete-poli/{id}', [AdminController::class, 'deletePoli'])->name('admin.delete_poli');
Route::middleware('role:admin')->get('/edit-poli/{id}', [AdminController::class, 'showEditPoliForm'])->name('admin.edit_poli.form');
Route::middleware('role:admin')->put('/edit-poli/{id}', [AdminController::class, 'editPoli'])->name('admin.edit_poli');
Route::middleware('role:admin')->get('/create-obat', [AdminController::class, 'showObatForm'])->name('admin.create_obat.form');
Route::middleware('role:admin')->post('/create-obat', [AdminController::class, 'createObat'])->name('admin.create_obat');
Route::middleware('role:admin')->get('/all-obat', [AdminController::class, 'showAllObat'])->name('admin.manage_obat');
Route::middleware('role:admin')->delete('/delete-obat/{id}', [AdminController::class, 'deleteObat'])->name('admin.delete_obat');
Route::middleware('role:admin')->get('/edit-obat/{id}', [AdminController::class, 'showEditObatForm'])->name('admin.edit_obat.form');
Route::middleware('role:admin')->put('/edit-obat/{id}', [AdminController::class, 'editObat'])->name('admin.edit_obat');
Route::middleware('role:admin')->get('/create-pasien', [AdminController::class, 'showPasienForm'])->name('admin.create_pasien.form');
Route::middleware('role:admin')->post('/create-pasien', [AdminController::class, 'createPasien'])->name('admin.create_pasien');
Route::middleware('role:admin')->get('/all-pasien', [AdminController::class, 'showAllPasien'])->name('admin.manage_pasien');
Route::middleware('role:admin')->delete('/delete-pasien/{id}', [AdminController::class, 'deletePasien'])->name('admin.delete_pasien');
Route::middleware('role:admin')->get('/edit-pasien/{id}', [AdminController::class, 'showEditPasienForm'])->name('admin.edit_pasien.form');
Route::middleware('role:admin')->put('/edit-pasien/{id}', [AdminController::class, 'editPasien'])->name('admin.edit_pasien');

Route::middleware('role:admin,dokter')->put('/edit-dokter/{id}', [AdminController::class, 'editDokter'])->name('admin.edit_dokter');
Route::middleware('role:admin,dokter')->get('/edit-dokter/{id}', [AdminController::class, 'showEditDokterForm'])->name('admin.edit_dokter.form');
