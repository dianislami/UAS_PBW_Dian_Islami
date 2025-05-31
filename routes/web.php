<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\LowonganController;
use App\Http\Controllers\DashboardController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/alumni', [AlumniController::class, 'index'])->name('alumni');
Route::get('/alumni/create', [AlumniController::class, 'create'])->name('tambah_alumni');
Route::post('/alumni', [AlumniController::class, 'store'])->name('alumni_store');
Route::get('/alumni/{alumni}', [AlumniController::class, 'show'])->name('detail_alumni');
Route::get('/alumni/{alumni}/edit', [AlumniController::class, 'edit'])->name('edit_alumni');
Route::put('/alumni/{alumni}', [AlumniController::class, 'update'])->name('alumni_update');
Route::delete('/alumni/{alumni}', [AlumniController::class, 'destroy'])->name('alumni-destroy');

Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan');
Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('tambah_lowongan');
Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan_store');
Route::get('/lowongan/{lowongan}', [LowonganController::class, 'show'])->name('lowongan.show');
Route::get('/lowongan/{lowongan}/edit', [LowonganController::class, 'edit'])->name('edit_lowongan');
Route::put('/lowongan/{lowongan}', [LowonganController::class, 'update'])->name('lowongan_update');
Route::delete('/lowongan/{lowongan}', [LowonganController::class, 'destroy'])->name('lowongan_destroy');


