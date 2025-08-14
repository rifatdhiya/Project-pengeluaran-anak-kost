<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\LaporanController;

// Redirect root ke dashboard
Route::get('/', fn() => redirect('/dashboard'));

// Dashboard utama
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// CRUD Pemasukan & Pengeluaran
Route::resource('pemasukan', PemasukanController::class)->except(['show', 'create', 'edit']);
Route::resource('pengeluaran', PengeluaranController::class)->except(['show', 'create', 'edit']);

// Laporan & Export PDF (opsional)
Route::get('/laporan', [LaporanController::class, 'index']);
Route::get('/laporan/pdf', [LaporanController::class, 'exportPDF']);
