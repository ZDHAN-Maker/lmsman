<?php

use App\Http\Controllers\AbsensiMuridController;
use App\Http\Controllers\AdminAbsensiController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KelasAdminController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KelasGuruController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratIzinController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/absensi', [AbsensiMuridController::class, 'index'])->name('absensi.index');
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');
    Route::get('/kelas', [KelasGuruController::class, 'index'])->name('kelas.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/kelas', [KelasAdminController::class, 'index'])->name('admin.kelas.kelas_admin.index');
    Route::get('/kelas/create', [KelasAdminController::class, 'create'])->name('admin.kelas.kelas_admin.create');
    Route::post('/kelas', [KelasAdminController::class, 'store'])->name('admin.kelas.kelas_admin.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/guru', [GuruController::class, 'index'])->name('admin.daftar_guru.index');
    Route::post('/guru/import', [GuruController::class, 'import'])->name('admin.daftar_guru.import');
    Route::post('/guru', [GuruController::class, 'store'])->name('admin.daftar_guru.store');

    //siswa Import
    Route::get('/siswa', [SiswaController::class, 'index'])->name('admin.daftar_siswa.index');
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('admin.daftar_siswa.import');
    Route::post('/siswa', [SiswaController::class, 'store'])->name('admin.daftar_siswa.store');
});

Route::middleware(['auth',])->group(function () {
    Route::get('/absensi', [AdminAbsensiController::class, 'index'])->name('admin.absensi_admin.index');
    Route::post('/absensi', [AdminAbsensiController::class, 'store'])->name('admin.absensi_admin.store');
    Route::get('/rekap-absensi', [AdminAbsensiController::class, 'rekap'])->name('admin.absensi_admin.rekap');
});
require __DIR__ . '/auth.php';
