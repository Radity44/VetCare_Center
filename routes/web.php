<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;

// Route::get('/', function () {
//     return view('Admin.DashboardAdmin');
// });

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('dokter', DoctorController::class);
Route::resource('pasien', PatientController::class);
Route::resource('layanan', ServiceController::class);
// Untuk update status (fase perawatan)
Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');


// Route placeholder untuk menu lain (nanti diisi)
// Route::get('/pasien', function() {
//     return 'Halaman Pasien (belum dibuat)';
// })->name('pasien.index');