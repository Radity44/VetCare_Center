 <?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AuthController;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\PatientController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\ServiceController;
// use App\Http\Controllers\VisitController;

// // ---------- ROOT REDIRECT KE LOGIN ----------
// Route::redirect('/', '/login');

// // ---------- AUTH (TIDAK PERLU LOGIN) ----------
// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login'])->name('login.process');

// // ---------- SEMUA ROUTE BUTUH LOGIN ----------
// Route::middleware('auth')->group(function () {
    
//     // Dashboard
//     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
//     // CRUD
//     Route::resource('dokter', DoctorController::class);
//     Route::resource('pasien', PatientController::class);
//     Route::resource('layanan', ServiceController::class);
//     Route::resource('kunjungan', VisitController::class); // ✅ TAMBAHAN
//     Route::get('kunjungan/{kunjungan}/struk', [VisitController::class, 'generateStruk'])
//      ->name('kunjungan.struk');
    
//     // Update status pasien
//     Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
//     Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');
    
//     // Logout
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// });

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\PatientController;
// use App\Http\Controllers\DoctorController;
// use App\Http\Controllers\ServiceController;

// Route::get('/', function () {
//     return view('Admin.DashboardAdmin');
// });

// Route::get('/login', function () {
//     return view('login');
// });

// Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
// Route::resource('dokter', DoctorController::class);
// Route::resource('pasien', PatientController::class);
// Route::resource('layanan', ServiceController::class);
// // Untuk update status (fase perawatan)
// Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
// Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');


// Route placeholder untuk menu lain (nanti diisi)
// Route::get('/pasien', function() {
//     return 'Halaman Pasien (belum dibuat)';
// })->name('pasien.index');

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VisitController;

// Root
Route::redirect('/', '/dashboard');

// Auth
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// ✅ CUSTOM ROUTES (HARUS DI ATAS Route::resource)
// Pasien custom routes
Route::get('pasien/{pasien}/status', [PatientController::class, 'editStatus'])->name('pasien.editStatus');
Route::post('pasien/{pasien}/status', [PatientController::class, 'updateStatus'])->name('pasien.updateStatus');

// ✅ Kunjungan custom routes (STRUK)
Route::get('kunjungan/{kunjungan}/struk', [VisitController::class, 'previewStruk'])
    ->name('kunjungan.struk');
Route::get('kunjungan/{kunjungan}/struk/download', [VisitController::class, 'downloadStruk'])
    ->name('kunjungan.struk.download');

// ✅ RESOURCE ROUTES (DI BAWAH)
Route::resource('pasien', PatientController::class);
Route::resource('dokter', DoctorController::class);
Route::resource('layanan', ServiceController::class);
Route::resource('kunjungan', VisitController::class);
