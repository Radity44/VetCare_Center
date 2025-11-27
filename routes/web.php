<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard-admin');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::redirect('/', '/login');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('dokter', DoctorController::class);
Route::resource('pasien', PatientController::class);
Route::resource('layanan', ServiceController::class);

// Untuk update status
Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');

// Route placeholder untuk menu lain
// Route::get('/pasien', function() {
//     return view;
// })->name('pasien.index');

Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');
