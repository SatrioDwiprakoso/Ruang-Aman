<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminKategoriController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TanggapanController;
use Illuminate\Support\Facades\Route;

// Landing Page (Publik)
Route::get('/', [LandingController::class, 'index'])->name('landing');

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === ROUTES PELAPOR ===
Route::middleware(['auth', 'role:pelapor'])->group(function () {
    Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pelapor.report.index');
    Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('pelapor.report.create');
    Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pelapor.report.store');
    Route::get('/pengaduan/{report}', [PengaduanController::class, 'show'])->name('pelapor.report.show');
    Route::get('/surat/{report}/cetak', [SuratController::class, 'generate'])->name('pelapor.surat.cetak');

    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('pelapor.notification.index');
    Route::post('/notifikasi/{notification}/read', [NotifikasiController::class, 'markAsRead'])->name('pelapor.notification.read');
    Route::post('/notifikasi/read-all', [NotifikasiController::class, 'markAllAsRead'])->name('pelapor.notification.readAll');

    Route::get('/profil', [ProfilController::class, 'edit'])->name('pelapor.profile.edit');
    Route::put('/profil', [ProfilController::class, 'update'])->name('pelapor.profile.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('pelapor.profile.password');
});

Route::get('/home', [LandingController::class, 'index'])->name('pelapor.home');

// === ROUTES ADMIN ===
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/pengaduan', [AdminDashboardController::class, 'reports'])->name('report.index');
    Route::get('/pengaduan/{report}', [AdminDashboardController::class, 'showReport'])->name('report.show');
    Route::post('/pengaduan/{report}/tanggapan', [TanggapanController::class, 'store'])->name('report.tanggapan');
    Route::get('/surat/{report}/cetak', [SuratController::class, 'generate'])->name('surat.cetak');

    Route::get('/kategori', [AdminKategoriController::class, 'index'])->name('kategori');
    Route::get('/kategori/buat', [AdminKategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori', [AdminKategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{category}/edit', [AdminKategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{category}', [AdminKategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{category}', [AdminKategoriController::class, 'destroy'])->name('kategori.destroy');
});