<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PasienController;

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
    return view('welcome');
});

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('role:pasien')->get('/dashboard-pasien', [PasienController::class, 'index'])->name('pasien.dashboard');
Route::middleware('role:admin')->get('/dashboard-admin', [AdminController::class, 'index'])->name('admin.dashboard');
Route::middleware('role:admin')->get('/create-dokter', [AdminController::class, 'showDokterForm'])->name('admin.create_dokter.form');
Route::middleware('role:admin')->post('/create-dokter', [AdminController::class, 'createDokter'])->name('admin.create_dokter');
Route::middleware('role:admin')->get('/all-dokter', [AdminController::class, 'showAllDokter'])->name('admin.manage_dokter');
Route::middleware('role:admin')->delete('/delete-dokter/{id}', [AdminController::class, 'deleteDokter'])->name('admin.delete_dokter');
Route::middleware('role:admin')->get('/edit-dokter/{id}', [AdminController::class, 'showEditDokterForm'])->name('admin.edit_dokter.form');
Route::middleware('role:admin')->put('/edit-dokter/{id}', [AdminController::class, 'editDokter'])->name('admin.edit_dokter');
